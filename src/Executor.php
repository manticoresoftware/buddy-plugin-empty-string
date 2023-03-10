<?php declare(strict_types=1);

/*
  Copyright (c) 2023, Manticore Software LTD (https://manticoresearch.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 2 or any later
  version. You should have received a copy of the GPL license along with this
  program; if you did not, you can find it at http://www.gnu.org/
*/
namespace Manticoresearch\Buddy\Plugin\EmptyString;

use Manticoresearch\Buddy\Core\Plugin\Executor as BaseExecutor;
use Manticoresearch\Buddy\Core\Task\Task;
use Manticoresearch\Buddy\Core\Task\TaskResult;
use RuntimeException;
use parallel\Runtime;

final class Executor extends BaseExecutor {
	/**
	 * Initialize the executor
	 *
	 * @param Request $request
	 * @return void
	 */
	public function __construct(public Request $request) {
	}

  /**
	 * Process the request
	 *
	 * @return Task
	 * @throws RuntimeException
	 */
	public function run(Runtime $runtime): Task {
		$taskFn = static function (): TaskResult {
			return new TaskResult(
				[[
					'total' => 0,
					'error' => '',
					'warning' => '',
				],
				]
			);
		};

		return Task::createInRuntime(
			$runtime, $taskFn, []
		)->run();
	}

	/**
	 * @return array<string>
	 */
	public function getProps(): array {
		return [];
	}
}
