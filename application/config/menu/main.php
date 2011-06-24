<?php
// $Id$


defined('SYSPATH') OR die('No direct access allowed.');

return array(
  'view' => '_menus/main',
  'current_class' => 'current',
  'items' => array(
    array(
      'url' => 'profile/index',
      'title' => __('My profile'),
    ),
    array(
      'url' => 'dashboard/index',
      'title' => __('Dashboard'),
    ),
    array(
      'url' => 'styles/index',
      'title' => __('Styles'),
      'items' => array(
        array(
          'url' => 'styles/index',
          'title' => __('Basic styles'),
        ),
        array(
          'url' => '#',
          'title' => __('Samples pages...'),
          'items' => array(
            array(
              'url' => 'files/index',
              'title' => __('Files'),
            ),
            array(
              'url' => 'products/index',
              'title' => __('Products'),
            ),
          ),
        ),
      ),
    ),
    array(
      'url' => 'grid/index',
      'title' => __('Grid'),
    ),
    array(
      'url' => 'tables/index',
      'title' => __('Tables'),
    ),
    array(
      'url' => 'forms/index',
      'title' => __('Forms'),
    ),
    array(
      'url' => 'graphs/index',
      'title' => __('Graphs'),
    ),
    array(
      'url' => 'admin/index',
      'title' => __('Administration'),
      'perms' => TRUE,
      'items' => array(
        array(
          'url' => 'translation/index',
          'title' => __('Translation'),
        ),
        array(
          'url' => 'admin/firms/unknown',
          'title' => __('Unknown firms'),
        ),
        array(
          'url' => 'admin/schools/unknown',
          'title' => __('Unknown schools'),
        ),
        array(
          'url' => 'admin/skills/unknown',
          'title' => __('Unknown skills'),
        ),
        array(
          'url' => 'admin/newsletters',
          'title' => __('Newsletters'),
        ),
      ),
    ),
  ),
);

