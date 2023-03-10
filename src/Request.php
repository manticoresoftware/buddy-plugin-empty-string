<?php declare(strict_types=1);

/*
  Copyright (c) 2023, Manticore Software LTD (https://manticoresearch.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 2 or any later
  version. You should have received a copy of the GPL license along with this
  program; if you did not, you can find it at http://www.gnu.org/
*/
namespace Manticoresearch\Buddy\Plugin\EmptyString;

use Manticoresearch\Buddy\Core\Network\Request as NetworkRequest;
use Manticoresearch\Buddy\Core\Plugin\Request as BaseRequest;

/**
 * This is simple do nothing request that handle empty queries
 * which can be as a result of only comments in it that we strip
 */
final class Request extends BaseRequest {
	public string $path;

  /**
	 * @param NetworkRequest $request
	 * @return static
	 */
	public static function fromNetworkRequest(NetworkRequest $request): static {
		$self = new static();
		// We just need to do something, but actually its' just for PHPstan
		$self->path = $request->path;
		return $self;
	}

	/**
	 * @param NetworkRequest $request
	 * @return bool
	 */
	public static function hasMatch(NetworkRequest $request): bool {
		return $request->payload === '' ||
				stripos($request->payload, 'set') === 0 ||
				stripos($request->payload, 'create database') === 0;
	}
}
