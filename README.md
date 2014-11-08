zf2MaintenanceMode
==================

# Introduction
A simple maintenance mode plugin for ZF2. When enabled displays a scheduled maintenance page, supports allowed IP addresses.

## Installation

### Using composer

1. Add `sheridan/zf2-maintenance-mode` (version `dev-master`) to requirements
2. Run `update` command on composer
3. Add `zf2MaintenanceMode` to your `application.config.php` file

### Manually

Clone this project into your `./vendor/` directory and enable it in your
`application.config.php` file.

### Requires

PHP >= 5.3.3

## Configuration

Create a config/maintenance.global.php file with the following contents

	```
		<?php
		return array(
			'zf2MaintenanceMode' => array (
			'enabled' => true,
			'retry-after' => 3600,
			'allowed' => array(
				'127.0.0.1',
			),
		);
	```
	
## Features

1. index.phtml file the content
2. layout.phtml overrides global site layout
