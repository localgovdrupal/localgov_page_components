<?php

namespace Drupal\Tests\localgov_page_components\Kernel;

use Drupal\KernelTests\KernelTestBase;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\paragraphs_library\Entity\LibraryItem;

/**
 * LinkIt integration tests for Link and Contact Page components.
 *
 * @group localgov_page_components
 */
class LinkItIntegrationTest extends KernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  protected static $modules = ['localgov_page_components'];

  /**
   * Integrates Page components with LinkIt.
   */
  public function setUp(): void {
    parent::setUp();

    $this->container->get('module_installer')->install([
      'user',
      'node',
      'linkit',
    ]);
    $this->container->get('module_installer')->install(['localgov_paragraphs']);

    // Integrate Page components with LinkIt.
    $this->defaultLinkItProfile = $this->container->get('entity_type.manager')->getStorage('linkit_profile')->load('default');
    $this->assertNotEmpty($this->defaultLinkItProfile);

    $this->pageComponentMatcherUuid = $this->defaultLinkItProfile->addMatcher([
      'id' => 'entity:paragraphs_library_item',
      'weight' => 0,
      'settings' => [
        'metadata' => '',
        'bundles'  => [
          'localgov_contact' => 'localgov_contact',
          'localgov_link' => 'localgov_link',
        ],
        'group_by_bundle' => TRUE,
        'substitution_type' => 'paragraphs_library_item_localgovdrupal',
        'limit' => 20,
      ],
    ]);
    $this->defaultLinkItProfile->save();
  }

  /**
   * Test for searching Link and Contact Page components.
   *
   * Creates a localgov_link and a localgov_contact Page components and then
   * searches those using our custom LinkIt matcher plugin.
   */
  public function testLinkItSearch() {

    $this->addLinkAndContactPageComponents();

    $matcher_plugin = $this->defaultLinkItProfile->getMatcher($this->pageComponentMatcherUuid);

    // First, search for a Link.
    $linkit_suggestions = $matcher_plugin->execute('Foo')->getSuggestions();
    $linkit_suggestions_count = count($linkit_suggestions);

    $expected_linkit_suggestions_count = 1;
    $this->assertEquals($linkit_suggestions_count, $expected_linkit_suggestions_count);

    // Next, search for a Contact.
    $linkit_suggestions = $matcher_plugin->execute('Baz')->getSuggestions();
    $linkit_suggestions_count = count($linkit_suggestions);

    $expected_linkit_suggestions_count = 1;
    $this->assertEquals($linkit_suggestions_count, $expected_linkit_suggestions_count);

    // Lastly, search for both Link and Contact.
    $linkit_suggestions = $matcher_plugin->execute('Test Paragraph')->getSuggestions();
    $linkit_suggestions_count = count($linkit_suggestions);

    $expected_linkit_suggestions_count = 2;
    $this->assertEquals($linkit_suggestions_count, $expected_linkit_suggestions_count);
  }

  /**
   * Creates necessary test data for search.
   */
  protected function addLinkAndContactPageComponents() {

    $link_para = Paragraph::create([
      'title' => 'Test Paragraph Foo bar',
      'type'  => 'localgov_link',
    ]);
    $link_para->save();
    $link_page_component = LibraryItem::create([
      'label' => 'Link: Test Paragraph Foo bar',
      'paragraphs' => $link_para,
    ]);
    $link_page_component->save();

    $contact_para = Paragraph::create([
      'title' => 'Test Paragraph Baz qux',
      'type'  => 'localgov_contact',
    ]);
    $contact_para->save();
    $contact_page_component = LibraryItem::create([
      'label' => 'Contact: Test Paragraph Baz qux',
      'paragraphs' => $contact_para,
    ]);
    $contact_page_component->save();
  }

  /**
   * LinkIt profile.
   *
   * @var Drupal\linkit\ProfileInterface
   */
  protected $defaultLinkItProfile;

  /**
   * UUID value assigned to our custom Matcher.
   *
   * @var string
   */
  protected $pageComponentMatcherUuid = '';

}
