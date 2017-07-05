<?php
$kirby->set('tag', 'table', array(
	'attr' => array(
		'class',
		'delimiter',
		'thead',
		'length'
	),
    'html' => function($tag) {
	    $file = $tag->file($tag->attr('table'));

		// add class if it's defined in markdown or config file
	    $class = (null !== $tag->attr('class') ? $tag->attr('class') : (null !== c::get('csvtotable.default.class') ? c::get('csvtotable.default.class') : ''));
	    $class = (null !== $class ? $class = ' class="'.$class.'"' : '');
	    
	    $thead = (null !==  $tag->attr('thead') ? $tag->attr('thead') : (null !== c::get('csvtotable.default.thead') ? c::get('csvtotable.default.thead') : false));

	    // default length is '0' unless set by user or config
	    $length = (null !== $tag->attr('length') ? $tag->attr('length')->bool() : (null !== c::get('csvtotable.default.length') ? c::get('csvtotable.default.length') : 0));

	    // default to semi-colon as delimiter if it's not set by the user in markdown or config file
	    $delimiter = (null !== $tag->attr('delimiter') ? $tag->attr('delimiter') : (null !== c::get('csvtotable.default.delimiter') ? c::get('csvtotable.default.delimiter') : ';'));

	    $html = '';
		$row = 0;

		if (($handle = fopen($file->url(), "r")) !== false) {
			$html .= '<table'.$class.'>';
			if($thead == null || $thead == false) {
				$html .= '<tbody>';
			}
			while (($data = fgetcsv($handle, $length, $delimiter)) !== false) {
				$num = count($data);
				$row++;

				// wrap first row with thead if it's set to true
				if($thead == true && $row == 1) {
					$html .= '<thead><tr>';
					for ($c=0; $c < $num; $c++) {
						$html .= '<th>' . $data[$c] . '</th>';
					}
					$html .= '</tr></thead><tbody>';
				} else {
				$html .= '<tr>';
					for ($c=0; $c < $num; $c++) {
						$html .= '<td>' . $data[$c] . '</td>';
					}
					$html .= '</tr>';
				}
			}
			fclose($handle);

			$html .= '</tbody></table>';
		}

		return $html;
	}
));