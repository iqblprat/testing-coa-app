<?php

use Maatwebsite\Excel\Excel;

return [
    'exports' => [
        'chunk_size'             => 1000,
        'pre_calculate_formulas' => false,
        'strict_null_comparison' => false,
        'csv'                    => [
            'delimiter'              => ',',
            'enclosure'              => '"',
            'line_ending'            => "\n",
            'use_bom'                => false,
            'include_separator_line' => false,
            'excel_compatibility'    => false,
        ],
    ],
    'imports' => [
        'heading'                 => 'slugged',
        'slug_separator'          => '_',
        'include_empty_rows'      => false,
        'default_null_value'      => null,
        'strict_null_comparison'  => false,
    ],
    'extension_detector' => [
        'xlsx'  => 'Xlsx',
        'xlsm'  => 'Xlsm',
        'xls'   => 'Xls',
        'csv'   => 'Csv',
        'ods'   => 'Ods',
        'html'  => 'Html',
        'tsv'   => 'Csv',
    ],
];
