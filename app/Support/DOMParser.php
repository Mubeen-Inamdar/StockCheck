<?php

namespace App\Support;

class DOMParser
{
    /**
     * Gets the stock for ASOS.
     *
     * @param String $dom
     * @return array
     */
    public static function asos(String $dom)
    {
        $html = getStringBetween($dom, 'css:{ required : noSizeSelected()}">', '</select>');

        $options = array_values(array_filter(explode('<option', $html)));
        unset($options[0]);
        $options = collect($options)->map(function ($option) {
            return '<option' . $option;
        });

        $allStock   = collect();
        $inStock    = collect();
        $outOfStock = collect();

        $options->each(function ($option) use (&$allStock, &$inStock, &$outOfStock) {
            if (strpos($option, 'disabled')) {
                $option = getStringBetween($option, '<option value="" disabled="">', ' - Not available</option>');
                $allStock->push($option);
                $outOfStock->push($option);
            } else {
                $option = getStringBetween($option, '<option value="">', '</option>');
                $allStock->push($option);
                $inStock->push($option);
            }
        });

        return [
            'allStock'   => $allStock,
            'inStock'    => $inStock,
            'outOfStock' => $outOfStock,
        ];
    }
}
