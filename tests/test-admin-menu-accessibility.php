<?php
/**
 * Class TestAdminMenuAccessibility
 *
 * @package Disk_Usage_Stats
 */

use TheDramatist\DiskUsageStats\AdminPages;

/**
 * Plugin activation and deactivation test case.
 */
class TestAdminMenuAccessibility extends WP_UnitTestCase {
	
	public function setUp() {
		parent::setUp();
		( new AdminPages\Bootstrap() )->menu();
	}
	
	public function test_is_accessible_by_administrator_true() {
		wp_set_current_user(
			self::factory()->user->create(
				array(
					'role' => 'administrator',
				)
			)
		);
		global $menu;
		$this->assertTrue( current_user_can( $menu[0][1] ) );
	}

	public function test_is_accessible_by_editor_false() {
		wp_set_current_user(
			self::factory()->user->create(
				array(
					'role' => 'editor',
				)
			)
		);
		global $menu;
		$this->assertFalse( current_user_can( $menu[0][1] ) );
	}

	public function test_is_accessible_by_author_false() {
		( new AdminPages\Bootstrap() )->menu();
		wp_set_current_user(
			self::factory()->user->create(
				array(
					'role' => 'author',
				)
			)
		);
		global $menu;
		$this->assertFalse( current_user_can( $menu[0][1] ) );
	}

	public function test_is_accessible_by_contributor_false() {
		( new AdminPages\Bootstrap() )->menu();
		wp_set_current_user(
			self::factory()->user->create(
				array(
					'role' => 'contributor',
				)
			)
		);
		global $menu;
		$this->assertFalse( current_user_can( $menu[0][1] ) );
	}

	public function test_is_accessible_by_subscriber_false() {
		( new AdminPages\Bootstrap() )->menu();
		wp_set_current_user(
			self::factory()->user->create(
				array(
					'role' => 'subscriber',
				)
			)
		);
		global $menu;
		$this->assertFalse( current_user_can( $menu[0][1] ) );
	}
}
