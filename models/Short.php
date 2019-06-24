<?php
	namespace models;

	class Short extends \Model
	{

		public function get_one_by_url ($url)
		{
			return $this->select_one('short', ['url' => $url]);
		}


		public function get_one_by_uid ($uid)
		{
			return $this->select_one('short', ['uid' => $uid]);
		}


		public function create ($url, $uid, $last_click)
		{
			return $this->insert('short', [
				'url' => $url,
				'uid' => $uid,
				'last_click' => $last_click,
			]);
		}


		public function update_last_click ($id, $timestamp)
		{
			$datas = ['last_click' => $timestamp];
			$where = ['id' => $id];
			return $this->update('short', $datas, $where);
		}


		public function delete_not_clicked_since ($date)
		{
			return $this->delete('short', [
				'<=last_click' => $date,
			]);
		}

	}