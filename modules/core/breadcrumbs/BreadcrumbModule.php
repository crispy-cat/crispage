<?php
	/*
		Crispage - A lightweight CMS for developers
		modules/core/breadcrumbs/BreadcrumbModule.php - Breadcrumb module

		Author: crispycat <the@crispy.cat> <https://crispy.cat>
		Since: 0.2.1
	*/

	namespace Crispage\Modules;

	defined("CRISPAGE") or die("Application must be started from index.php!");

	class BreadcrumbModule extends \Crispage\Assets\Module {
		public function render() {
			global $app;

			$slug = explode("/", $app->request->slug);

			$breadcrumbs = array(
				array(
					"url" => \Config::WEBROOT . "/",
					"label" => $this->options["roottext"]
				)
			);
			if ($app->request->slug != "index") {
				foreach ($slug as $key => $part) {
					$crumb = array("url" => \Config::WEBROOT);
					for ($i = 0; $i <= $key; $i++)
						$crumb["url"] .= "/" . $slug[$i];
					if (isset($app->request->route["view"]) && $key == count($slug) - 1) {
						if ($app->request->route["view"] == "article")
							$crumb["label"] = $app("articles")->get($part)->title;
						elseif ($app->request->route["view"] == "category")
							$crumb["label"] = $app("categories")->get($part)->title;
						else
							$crumb["label"] = ucfirst(preg_replace("/[_-]/", " ", $part));
					} else {
						$cat = $app("categories")->get($part);
						if ($cat)
							$crumb["label"] = $cat->title;
						else
							$crumb["label"] = ucfirst(preg_replace("/[_-]/", " ", $part));
					}
					$breadcrumbs[] = $crumb;
				}
			}
?>
			<div class="module BreadcrumbModule module-<?php echo $this->id . " " . $this->options["classes"]; ?>">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
<?php
					foreach ($breadcrumbs as $key => $crumb) {
?>
						<li class="breadcrumb-item <?php echo ($key == count($breadcrumbs) - 1) ? "active" : ""; ?>"><a href="<?php echo $crumb["url"]; ?>"><?php echo $crumb["label"]; ?></a></li>
<?php
					}
?>
					</ol>
				</nav>
			</div>
<?php
		}
	}
?>
