<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ActivityController;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

use App\Models\Activity;
use App\Models\Item;
use App\Models\HostActivity;
use App\Models\CategoryActivity;
use App\Models\Category;
use App\Models\ItemType;
use App\Models\Language;
use App\Models\Host;

use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Session;

class ItemController extends Controller
{
    /**
     * Returns item type detail page of specific item
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showDetails($id)
    {
        //Vai buscar o item e o tipo do item
        $item = Item::find($id);
        $itemType = ItemType::find($item->item_type_id);

        //Procura por tipo de artigo
        switch ($item->item_type_id) {
            case 1:
            { //Atividade
                $activity = Activity::find($id);

                //No caso da atividade vai buscar ainda as categorias e a linguagem
                $category = ActivityController::getActivityCategories($id);
                $language = Language::find($activity->language_id);

                return view('activity.activityDetails', ['item' => $item,
                    'itemType' => $itemType,
                    'activity' => $activity,
                    'categories' => $category,
                    'language' => $language
                ]);
            }
            default:
            {
                redirect('home');
            }
        }
    }

    /**
     * Funcao chamada quando efetuamos uma pesquisa sem filtros
     * Funcao chamada pela rota /search/results
     */
    public function defaultSearch(Request $request)
    {
        if ($request->search == null) {
            //Se a pesquisa não tiver nada, ele pesquisa por todas as atividades
            return ItemController::searchItems('');
        }
        return ItemController::searchItems($request->search);
    }


    /**
     * Search for items based on the entered string in activity name or category name.
     *
     * @param string $searchQuery
     * @param string|null $order_by
     * @param string $order_direction
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public static function searchItems(string $searchQuery, string $order_by = null, string $order_direction = 'asc')
    {
        /**
         * Procura por todas as referencias relacionadas às atividades
         *
         * Se tiver aplicado uma ordenacao faz a pesquisa com ordenacao
         */
        $resultsQuery = Activity::select(['activity.item_id as item_id', 'activity.title as item_name'])
            ->where(function ($query) use ($searchQuery) {
                $query->orWhere('title', 'LIKE', "%{$searchQuery}%")
                    ->orWhereHas('category', function ($query) use ($searchQuery) {
                        $query->where('name', 'LIKE', "%{$searchQuery}%");
                    });
            });

        if ($order_by !== null && $order_by !== '0') {
            $resultsQuery->orderBy($order_by, $order_direction);
        }

        $results = $resultsQuery->get();

        /**
         * Vai buscar todos os filtros que sao possiveis aplicar aos resultados
         * Vai ser utilizado para popular dinamicamente o conteudo nos accordion de filtros
         */
        $possibleFilterOptions = [
            'category' => ItemController::getFilterOptions(
                $searchQuery,
                ['category.id', 'category.name']
            ),
        ];

        /**
         * Aqui são guardadados todos os dados do url atual
         * E utilizado para manter filtros.
         * Por exemplo.: search/results/filter/{substring}/1/0, ele vai filtrar os resultados de substring pelos livros escritos por o autor.id = 1
         * sarch/results/filter/{substring}/1/1, aos resultados anteriores ele vai aplicar um novo filtro pelos livros publicados pela publisher.id = 1
         *
         * Quando o valor e 0 significa que nenhum filtro foi aplicado
         */
        $url = [
            "searchQuery" => $searchQuery == '' ? 0 : $searchQuery,
            "filters" => [
                'category' => 0,
            ],
            "order_by" => $order_by ?: 0,
            "order_direction" => $order_direction,
        ];

        return view('search/results', ['url' => $url, 'results' => $results, 'possibleFilterOptions' => $possibleFilterOptions]);
    }


    /**
     * Dentre os resultados da pesquisa atual, essa funcao busca os filtros possiveis
     * baseado nas colunas especificadas em @param $filterColumns
     *
     * Esta função serve para popular o accordion dos diversos filtros (autores, editores, etc...)
     *
     */
    public static function getFilterOptions(string $searchQuery, array $filterColumns, int $host_id = null,
                                            int $category_id = null): \Illuminate\Support\Collection
    {
        $query = ActivityController::buildSearchActivitiesQuery($searchQuery, $filterColumns,
            category_id: $category_id);

        return $query
            /**
             * Agrupa por id's
             */
            ->groupBy($filterColumns[0])
            /**
             * Adiciona um count
             */
            ->addSelect(DB::raw('count('.$filterColumns[0].')'))
            ->get();
    }
}

