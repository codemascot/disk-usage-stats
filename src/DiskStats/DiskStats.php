<?php # -*- coding: utf-8 -*-

namespace TheDramatist\DiskUsageStats\DiskStats;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Class DiskStats
 *
 * @package TheDramatist\DiskUsageStats\DiskStats
 */
class DiskStats {

	/**
	 *
	 */
	const RAW_OUTPUT = true;

	/**
	 * @var string
	 */
	private $disk_path;

	/**
	 * @var array
	 */
	private $files = [];

	/**
	 * DiskStats constructor.
	 *
	 * @param $disk_path
	 */
	public function __construct( $disk_path ) {
		$this->disk_path = apply_filters( 'dus_target_path', $disk_path );
	}

	/**
	 * @param bool $raw_output
	 *
	 * @return bool|float|string
	 * @throws \Exception
	 */
	public function total_space( $raw_output = false ) {
		$disk_total_space = @disk_total_space( $this->disk_path );
		if ( false === $disk_total_space ) {
			throw new \Exception(
				__( 'Invalid disk path.', 'disk-usage-stats' )
			);
		}
		return $raw_output ? $disk_total_space
			: $this->add_units( $disk_total_space );
	}

	/**
	 * @param bool $raw_output
	 *
	 * @return bool|float|string
	 * @throws \Exception
	 */
	public function free_space( $raw_output = false ) {
		$disk_free_space = @disk_free_space( $this->disk_path );
		if ( false === $disk_free_space ) {
			throw new \Exception(
				__( 'Invalid disk path.', 'disk-usage-stats' )
			);
		}
		return $raw_output ? $disk_free_space
			: $this->add_units( $disk_free_space );
	}

	/**
	 * @param int $precision
	 *
	 * @return float
	 * @throws \Exception
	 */
	public function used_space( $precision = 1 ) {
		try {
			return round(
				( 100 - (
					$this->free_space(
						self::RAW_OUTPUT
					) / $this->total_space(
						self::RAW_OUTPUT
					)
				) * 100 ),
				$precision
			);
		} catch ( \Exception $e ) {
			throw $e;
		}
	}

	/**
	 * @param string $dir
	 *
	 * @return array
	 */
	public function dir_or_file_stats( $dir = '' ) {
		if ( empty( $dir ) || '' === $dir ) {
			$dir = $this->disk_path;
		}
		
		if ( is_file( $dir ) ) {
			return [
				'size' => filesize( $dir ),
				'name' => $dir,
				'count' => 0,
			];
		}

		if ( $dh = opendir( $dir ) ) {
			$size = 0;
			$n    = 0;
			while ( false !== $file = readdir( $dh ) ) {
				if ( '.' === $file || '..' === $file ) {
					continue;
				}
				$n ++;
				$data = $this->dir_or_file_stats( $dir . '/' . $file );
				$this->files[ $data['name'] ] = $data['size'];
				$size += $data['size'];
				$n    += $data['count'];
			}
			closedir( $dh );
			return [
				'size' => $size,
				'count' => $n,
				'files' => $this->files,
			];
		}
		return [
			'size' => 0,
			'count' => 0,
		];
	}

	/**
	 * @return string
	 */
	public function get_disk_path() {
		return $this->disk_path;
	}

	/**
	 * @param int $bytes
	 *
	 * @return string
	 */
	public function add_units( $bytes = 0 ) {
		$units = [ 'B', 'KB', 'MB', 'GB', 'TB' ];
		for ( $i = 0; $bytes >= 1024 && $i < count( $units ) - 1; $i ++ ) {
			$bytes /= 1024;
		}
		return round( $bytes, 1 ) . ' ' . $units[ $i ];
	}
}
