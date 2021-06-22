<?php


namespace App\Components;


class CommentsHelper
{
    public static function extract_mentions_from_json(&$array, &$results)
    {
        if (isset($array['type'])) {
            if (
                $array['type'] == 'mention' &&
                !in_array($array['attrs']['id'], $results)
            ) {
                $results[] = $array['attrs']['id'];
            }

            if ($array['type'] == 'text') {
                if (!$array['text']) {
                    $array['text'] = ' ';
                }
            }
        }
        if (isset($array['content'])) {
            foreach ($array['content'] as $i => $node) {
                self::extract_mentions_from_json($array['content'][$i], $results);
            }
        }
    }

}
