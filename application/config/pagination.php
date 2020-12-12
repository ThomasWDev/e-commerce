<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/** PAGINATION Custom class**/

$config = array(
    'full_tag_open'   => '<div class="pagination flex-m flex-w p-t-26">',
    'full_tag_close'  => '</div>',
    'first_tag_open'  => '<div>',
    'first_tag_close' => '</div>',
    'last_tag_open'   => '<div>',
    'last_tag_close'  => '</div>',
    'next_link'       => '<i class="fa fa-angle-right"></i>',
    'next_tag_open'   => '<div>',
    'next_tag_close'  => '</div>',
    'prev_link'       => '<i class="fa fa-angle-left"></i>',
    'prev_tag_open'   => '<div>',
    'prev_tag_close'  => '</div>',
    'cur_tag_open'    => '<a href="#" class="item-pagination flex-c-m trans-0-4 active-pagination">',
    'cur_tag_close'   => '</a>',
    'num_tag_open'    => '<div>',
    'num_tag_close'   => '</div>',
    'num_links'       => 2,
    'attributes' =>  array('class' => 'item-pagination flex-c-m trans-0-4'),
);

$config['page_query_string'] = TRUE;