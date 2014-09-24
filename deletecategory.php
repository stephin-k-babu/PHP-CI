<?php
public function delete_courses () //special case to delete courses and its subcategories
        {
            $tblname = 'cms_course';
            $id      = $this->input->post('courseid');
            $m       = $this->getcourseid($id);
            for ( $i = 0; $i < count($m); $i++ )
            {
                $values['id'] = $m[$i];
                $z            = $this->db_functions->delete_contents($tblname, $values);
            }
            if ( $z )
            {
                $data['d'] = 'deleted';
                $this->load->view('pages/ajaxview', $data);
            }
            else
            {
                $data['d'] = "Sorry";
                $this->load->view('pages/ajaxview', $data);
            }
        }
 
        function getcourseid ( $id1 )
        {
            $parentid = $id1;
            $y[]      = $id1;
            $query    = $this->db->query("select id from cms_course where parentid = $parentid");
            $rows     = $query->result_array();
            foreach ( $rows as $row )
            {
                $z = $this->getcourseid($row['id']);
                $k = 0;
                foreach ( $z as $a )
                {
                    $y[] = $a[$k];
                }
            }
            return $y;
        }
?>
