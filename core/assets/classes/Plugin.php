<?php
	/*
		Crispage - A lightweight CMS for developers
		core/assets/classes/plugins.php - Plugin class

		Author: crispycat <the@crispy.cat> <https://crispy.cat>
		Since: 0.2.0
	*/

	namespace Crispage\Assets;

	defined("CRISPAGE") or die("Application must be started from index.php!");

	class Plugin extends Asset {
		public string $class;
		public int $priority;
		public string $scope;

		public function __construct(array $data) {
			parent::__construct("Plugin", $data);
			if (!is_array($data)) return;
			$this->class = (string)($data["class"] ?? "");
			$this->priority = (int)($data["priority"] ?? 0);
			$this->scope = (string)($data["scope"] ?? "frontend");
		}

		public function execute() {}
	}
