<?php
	namespace controllers\internals;

	use \models\Short as ModelShort;

	class ShortConsole extends \InternalController
	{
		/**
		 * Console script to delete olds shorts
		 */
		public static function delete_olds_shorts (int $nb_days)
		{
        	$pdo = \Model::connect(DATABASE_HOST, DATABASE_NAME, DATABASE_USER, DATABASE_PASSWORD);
			$model_short = new ModelShort($pdo);

			$since = time() - (60 * 60 * 24 * $nb_days);

			$nb_delete = $model_short->delete_not_clicked_since($since);
			echo "We have deleted " . $nb_delete . " shorts.\n";
		}
	}