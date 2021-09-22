# LocalGovDrupal Page Components

Reusable paragraphs library for the LocalGovDrupal distribution.

## What's in it?
### A node field
Provides the **localgov_page_components** node field.  This field can be used to add new Page components or select an existing one within a node.  The recommended field widget is **Entity browser** which should use the *Page component* browser.

This field is currently used in the localgov_services_page content type.  But it can be used in any other content type.

### LinkIt integration
When the [LinkIt](https://www.drupal.org/project/linkit) module is available, its **Default** profile will be configured to use URLs from localgov_link and localgov_contact Page components which come from the [localgov_paragraphs](https://packagist.org/packages/localgovdrupal/localgov_paragraphs) module.

To configure **other** LinkIt profiles, follow these steps:
- Access the LinkIt profile configuration page from */admin/config/content/linkit*.
- Select the *Manage matchers* operation for the target profile.
- Click *Add matcher*.
- Select **Page components** as the matcher.  *Save and continue*.  This should present the *Page components* matcher edit form.
- Select *Link* and *Contact* as *Bundle restrictions*.  Other Paragraph types are unsupported at the moment.
- *Limit search results* to 20.
- Select the *Group by bundle* checkbox within *Bundle grouping*.
- Select *Page components* from the **Substitution Type** dropdown within *URL substitution*.
- *Save changes*.
- Suggestions provided by LinkIt for this profile should now include localgov_link and localgov_contact Page components.

### WYSIWYG integration
It is possible to embed Page components from within the WYSIWYG.  This is an *optional* feature.  Setup steps are as follows:
- Select the target text format from */admin/config/content/formats*.
- Enable the **Display embedded entities** filter.
- If the *Limit allowed HTML tags and correct faulty HTML* filter is enabled, add this tag in its filter settings: ```<drupal-entity data-entity-type data-entity-uuid data-entity-embed-display data-entity-embed-display-settings data-align data-caption data-embed-button alt title>```
- Drag the *Page component* button into the WYSIWYG's active toolbar.
- *Save configuration*.
- If this text format is later selected when editing a textarea, the Page component embed button should appear in the WYSIWYG's toolbar.

#### Good to know
For best results, ensure CKEditor is [loading stylesheets](https://www.drupal.org/docs/theming-drupal/defining-a-theme-with-an-infoyml-file#ckeditor_stylesheets) for any embedded Page component.

#### Troubleshooting
An embedded Page component's markup can break if it does not conform to CKEditor's DTD rules.  If this happens, extend the DTD rules.  The [bundled CKEditor plugin](js/ckeditor-plugins/localgov_page_components/plugin.js) serves as an example.
