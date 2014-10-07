<?php
    if ( !defined('BASEPATH') )
    {
        exit( 'No direct script access allowed' );
    }

    class Db_functions extends CI_Model
    {
        //function to get elements
        function get_contents ( $table, $value = FALSE )
        {
            if ( $value === FALSE )
            {
                $query = $this->db->get($table);
                return $query->result_array();
            }
            $query = $this->db->get_where($table, $value);
            return $query->result_array();
        }

        //function to get specific contents
        function get_specific ( $table, $fields, $value = FALSE )
        {
            if ( $value === FALSE )
            {
                $this->db->select($fields);
                $query = $this->db->get($table);
                return $query->result_array();
            }
            $this->db->select($fields);
            $query = $this->db->get_where($table, $value);
            return $query->result_array();
        }

        //function to insert elements
        function put_contents ( $table, $value )
        {
            return $this->db->insert($table, $value);
        }

        //function to update elements
        function update_contents ( $table, $value, $conditions = FALSE )
        {
            if ( $conditions === FALSE )
            {
                return $this->db->update($table, $value);
            }
            return $this->db->update($table, $value, $conditions);
        }

        //function to delete elements
        function delete_contents ( $table, $conditions = FALSE )
        {
            if ( $conditions == FALSE )
            {
                return $this->db->delete($table);
            }
            return $this->db->delete($table, $conditions);
        }

        //function to get count
        function countdata ( $tblname, $condition )
        {
            $this->db->from($tblname)->where($condition);
            return $this->db->count_all_results();
        }

        //function to return insert id
        function getinsertid ()
        {
            return $this->db->insert_id();
        }

        //function to get data using join
        public function get_joins ( $table, $columns, $joins, $order = FALSE )
        {
            /*sample join array
            $joins = array(
                array(
                    'table' => 'table2',
                    'condition' => 'table2.id = table1.id',
                    'jointype' => 'INNER JOIN'
                ),
            );*/
            $this->db->select($columns)->from($table);
            if ( is_array($joins) && count($joins) > 0 )
            {
                foreach ( $joins as $k => $v )
                {
                    $this->db->join($v['table'], $v['condition'], $v['jointype']);
                }
            }
            if ( $order != FALSE )
            {
                $this->db->order_by($order);
            }
            return $this->db->get()->result_array();
        }

        //function to get specific data using join
        public function get_joins_specific ( $table, $columns, $joins, $condition, $order = FALSE )
        {
            $this->db->select($columns)->from($table);
            if ( is_array($joins) && count($joins) > 0 )
            {
                foreach ( $joins as $k => $v )
                {
                    $this->db->join($v['table'], $v['condition'], $v['jointype']);
                }
            }
            $this->db->where($condition);
            if ( $order != FALSE )
            {
                $this->db->order_by($order);
            }
            return $this->db->get()->result_array();
        }
    }

?>
