/**
 * @file
 * A CKEditor plugin to apply site-specific changes.
 *
 * Our changes:
 * - Convince the div and span tags to accept the meta tag as a child element.
 *   This is needed for geolocation fields.
 *
 * @see https://ckeditor.com/docs/ckeditor4/latest/guide/plugin_sdk_sample.html
 * @see CKEDITOR.htmlParser.fragment.fromHtml()
 */

(function fineTuneCKEditor(jQuery, Drupal, CKEDITOR) {
  /**
   * CKEditor DTD rule update.
   *
   * The div and span elements should allow the meta element as a child or
   * *grandchild*.
   */
  function letDivAndSpanAcceptMetaAsChild() {
    CKEDITOR.dtd.div.meta = 1;
    CKEDITOR.dtd.span.meta = 1;
  }

  CKEDITOR.plugins.add("localgov_page_components", {
    /* eslint no-unused-vars: ["error", { "args": "none" }] */
    beforeInit: function(editor) {
      letDivAndSpanAcceptMetaAsChild();
    }
  });
})(jQuery, Drupal, CKEDITOR);
