<?php

use function FAIR\Version_Check\get_browser_data;

/**
 * Test the browser user-agent parser.
 *
 * @covers FAIR\Version_Check\get_browser_data
 */
class GetBrowserDataTest extends WP_UnitTestCase {

	/**
	 * Get pairs of user-agents and expected parsed results.
	 *
	 * @return array[]
	 */
	private function data_user_agents() {
		return [
			'simple agent' => [
				'agent'    => 'Mozilla/5.0',
				'expected' => [
					'Mozilla' => '5.0',
				],
			],
			'complex agent' => [
				'agent'    => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36 Edg/91.0.864.64',
				'expected' => [
					'Mozilla'     => '5.0',
					'AppleWebKit' => '537.36',
					'Chrome'      => '91.0.4472.124',
					'Safari'      => '537.36',
					'Edg'         => '91.0.864.64',
				],
			],
			'empty agent' => [
				'agent'    => '',
				'expected' => [],
			],
			'invalid agent' => [
				'agent'    => 'some string / with no version (and meta)',
				'expected' => [],
			],
		];
	}

	/**
	 * Test parsing user-agent strings.
	 *
	 * @dataProvider data_user_agents
	 *
	 * @return void
	 */
	public function test_can_parse_user_agent( $agent, $expected ) {
		$browser_data = get_browser_data( $agent );

		$this->assertIsArray( $browser_data, 'Expecting pairs of names and versions' );
		$this->assertEquals( $expected, $browser_data );
	}

}
