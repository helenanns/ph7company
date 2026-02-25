<?php
return [
    'key' => 'group_products',
    'title' => 'Products Section',
    'fields' => [
        [
            'key' => 'field_products_repeater',
            'label' => 'Products Blocks',
            'name' => 'products',
            'type' => 'repeater',
            'button_label' => 'Adicionar bloco de produtos',
            'sub_fields' => array(
                array(
                    'key' => 'field_products_layout',
                    'label' => 'Layout',
                    'name' => 'layout',
                    'type' => 'select',
                    'choices' => array(
                        'grid' => 'Grid',
                        'carousel' => 'Carousel',
                    ),
                    'default_value' => 'grid',
                ),
                array(
                    'key' => 'field_products_theme',
                    'label' => 'Tema',
                    'name' => 'theme',
                    'type' => 'select',
                    'choices' => array(
                        'light' => 'Claro',
                        'dark'  => 'Escuro',
                    ),
                    'default_value' => 'light',
                ),
                array(
                    'key' => 'field_products_title',
                    'label' => 'Título',
                    'name' => 'title',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_products_items',
                    'label' => 'Produtos',
                    'name' => 'products',
                    'type' => 'relationship',
                    'post_type' => array('product'),
                    'filters' => array('search', 'post_type'),
                    'return_format' => 'object',
                ),
                array(
                    'key' => 'field_products_link',
                    'label' => 'Link',
                    'name' => 'link',
                    'type' => 'link',
                    'return_format' => 'array',
                ),
            ),
        ],
    ],
    'location' => [
    [
        [
        'param' => 'page_template',
        'operator' => '==',
        'value' => 'template-homepage.php',
        ],
    ],
    ],
];

