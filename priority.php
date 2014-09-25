 //function to update the tablefield priority
 public function updateList ()
        {
            $array = $_POST['arrayorder'];
            if ( $_POST['update'] == "update" )
            {
                $count = 1;
                foreach ( $array as $idval )
                {
                    $query = "UPDATE cms_college SET priority = " . $count . " WHERE collegeid = " . $idval;
                    $this->db->query($query);
                    $count++;
                }
                $data['d'] = 'All saved! refresh the page to see the changes';
                $this->load->view('pages/ajaxview', $data);
            }
        }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////        
//ajax function in the user interface to send data to the updateList function
<script type = "text/javascript">
    $( document ).ready( function ()
                         {
                             function slideout()
                             {
                                 setTimeout( function ()
                                             {
                                                 $( "#response" ).slideUp( "slow", function ()
                                                 {
                                                 } );

                                             }, 2000 );
                             }

                             $( "#response" ).hide();
                             $( function ()
                                {
                                    $( "#list_new ul" ).sortable( { opacity: 0.8, cursor: 'move', update: function ()
                                    {

                                        var order = $( this ).sortable( "serialize" ) + '&update=update';
                                        $.post( '<?php echo base_url();?>index.php/customajax/updateList', order, function ( theResponse )
                                        {
                                            $( "#response" ).html( theResponse );
                                            $( "#response" ).slideDown( 'slow' );
                                            slideout();
                                        } );
                                    }
                                                                  } );
                                } );

                         } );
</script>
//////////////////////////////////////@@@@@@@@@@@@@@@@@@@@@@@@@@html side@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@/////////////////
 <div id = "list_new">

                    <div id = "response"></div>


                    <ul>
                        <?php
                            $i = 0;

                            foreach ( $contents as $content )
                            {
                                $i++;

                                ?>
                                <li id = "arrayorder_<?php echo $content['collegeid']; ?>"><?php echo $i ?>
                                    .<?php echo $content['collegename'] . "  (" . $content['countryname'] . ")"; ?>
                                    <div class = "clear"></div>
                                </li>
                            <?php } ?>
                    </ul>
                </div>
                <style>
    ul
    {
        padding : 0px;
        margin  : 0px;
    }

    #response
    {
        padding          : 10px;
        background-color : #9F9;
        border           : 2px solid #396;
        margin-bottom    : 20px;
    }

    #list_new li
    {
        margin           : 0 0 3px;
        padding          : 8px;
        background-color : #333;
        color            : #fff;
        list-style       : none;
    }
</style>
   /////////////////////////////////////////////end////////////////////////////////////////////////////////////////////     
