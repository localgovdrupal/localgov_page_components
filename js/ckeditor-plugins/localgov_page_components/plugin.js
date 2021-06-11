/**
 * @file
 * A CKEditor plugin to apply site-specific changes.
 *
 * Our changes:
 * - Convince the span tag to accept the meta tag as a child element.  This is
 *   needed for geolocation fields.
 *
 * @see https://ckeditor.com/docs/ckeditor4/latest/guide/plugin_sdk_sample.html
 */

(function fineTuneCKEditor(jQuery, Drupal, CKEDITOR) {
  /**
   * The span element should allow the meta element as a child.
   */
  function letSpanAcceptMetaAsChild() {
    CKEDITOR.dtd.span.meta = 1;
  }

  CKEDITOR.plugins.add("localgov_page_components", {
    /* eslint no-unused-vars: ["error", { "args": "none" }] */
    beforeInit(editor) {
      letSpanAcceptMetaAsChild();
    }
  });
})(jQuery, Drupal, CKEDITOR);
