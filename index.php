<?php
Kirby::plugin('lauriiii/csv-to-table', [
    'tags' => [
        'table' => [
            'attr' => ['delimiter', 'length', 'class', 'thead', 'offset'],
            'html' => function($tag) {
                $page = $tag->parent();
				if (!$page) {
				    return '';
				}
				$file = $page->file($tag->value);

                if (!$file) {
                    return '';
                }

                $delimiterOption = $tag->delimiter ?? option('lauriiii.csv-to-table.delimiter', ';');
				$delimiter = (is_string($delimiterOption) && strlen($delimiterOption) === 1) ? $delimiterOption : ';';
                $length    = (int)($tag->length ?? option('lauriiii.csv-to-table.length', 0));
                $class     = $tag->class ?? option('lauriiii.csv-to-table.class', '');
                $theadValue = $tag->thead ?? option('lauriiii.csv-to-table.thead', false);
				$thead = filter_var($theadValue, FILTER_VALIDATE_BOOLEAN);
                $offset    = max(0, (int)($tag->offset ?? option('lauriiii.csv-to-table.offset', 0)));

                $rows = [];
                if (($handle = fopen($file->root(), 'r')) !== false) {
                    while (($data = fgetcsv($handle, $length, $delimiter, '"', '\\')) !== false) {
                        $rows[] = $data;
                    }
                    fclose($handle);
                }

                if (empty($rows)) {
                    return '';
                }

                $renderRows = function(array $rows): string {
                    $output = '';
                    foreach ($rows as $row) {
                        $output .= '<tr>';
                        foreach ($row as $cell) {
                            $output .= '<td>' . esc((string)$cell) . '</td>';
                        }
                        $output .= '</tr>';
                    }
                    return $output;
                };

                $class = $class ? ' class="' . esc($class) . '"' : '';
                $html  = '<table' . $class . '>';

                if ($thead) {
                    $headerRow = array_shift($rows);
                    $rows = array_slice($rows, $offset);

                    $html .= '<thead><tr>';
                    foreach ($headerRow as $cell) {
                        $html .= '<th>' . esc((string)$cell) . '</th>';
                    }
                    $html .= '</tr></thead><tbody>';
                    $html .= $renderRows($rows);
                    $html .= '</tbody>';
                } else {
                    $rows = array_slice($rows, $offset);
                    $html .= $renderRows($rows);
                }

                $html .= '</table>';
                return $html;
            }
        ]
    ]
]);