<?php

declare(strict_types = 1);

namespace Drupal\localgov_page_components\Plugin\CKEditorPlugin;

use Drupal\ckeditor\CKEditorPluginContextualInterface;
use Drupal\editor\Entity\Editor;
use Drupal\Component\Plugin\PluginBase;

/**
 * Fine tune CKEditor.
 *
 * Our changes:
 * - Convince the span tag to accept the meta tag as a child element.  This is
 *   needed for embedding entities with geolocation fields.
 *
 * @CKEditorPlugin (
 *   id = "localgov_page_components",
 *   label = @Translation("Page component embed")
 * );
 */
class PageComponentEmbed extends PluginBase implements CKEditorPluginContextualInterface {

  /**
   * {@inheritdoc}
   *
   * This plugin should be loaded at all times.
   */
  public function isEnabled(Editor $editor) {

    return TRUE;
  }

  /**
   * {@inheritdoc}
   *
   * Location of our CKEditor plugin file.
   */
  public function getFile() {

    return drupal_get_path('module', 'localgov_page_components') . '/js/ckeditor-plugins/localgov_page_components/plugin.js';
  }

  /**
   * {@inheritdoc}
   */
  public function isInternal() {

    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function getDependencies(Editor $editor) {

    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function getLibraries(Editor $editor) {

    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function getConfig(Editor $editor) {

    return [];
  }

}
