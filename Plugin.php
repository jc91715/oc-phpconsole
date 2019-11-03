<?php namespace RV\PhpConsole;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{

    public function boot()
    {
        \Event::listen('offline.sitesearch.query', function ($query) {

            // Search your plugin's contents
            $items = \RV\PhpConsole\Models\Script::
            Where('title', 'like', "%${query}%")
            ->orWhere('description', 'like', "%${query}%")
                ->get();
            // Now build a results array
            $results = $items->map(function ($item) use ($query) {

                // If the query is found in the title, set a relevance of 2
                $relevance = mb_stripos($item->title, $query) !== false ? 2 : 1;

                // Optional: Add an age penalty to older results. This makes sure that
                // newer results are listed first.
                // if ($relevance > 1 && $item->published_at) {
                //     $relevance -= $this->getAgePenalty($item->published_at->diffInDays(Carbon::now()));
                // }
                return [
                    'title'     => $item->title,
                    'text'      => $item->description,
                    'url'       => '/code-script/'.$item->id,
                    'thumb'     => null ,// Instance of System\Models\File
                    'relevance' => $relevance, // higher relevance results in a higher
                    // position in the results listing
                    // 'meta' => 'data',       // optional, any other information you want
                    // to associate with this result
                    // 'model' => $item,       // optional, pass along the original model
                ];
            });

            return [
                'provider' => '--来自代码片段', // The badge to display for this result
                'results'  => $results,
            ];
        });
    }

    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }
}
