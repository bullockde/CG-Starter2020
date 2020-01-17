 <div class="gallery">
    
    <?php
        if(count($img_locs) > 1 || (!empty($row["youtube_url"]) && count($img_locs) > 0)){
            ?>
            <h4 class='text-center gallery'>Gallery</h4><hr>

            <!-- Images used to open the lightbox -->
            <div class="row">

            <!-- Images used to open the lightbox -->
        
            <?php
                    $iml_cnt = count($img_locs);
                    if($iml_cnt > 0){
                    
                        for($i=0;$i<$iml_cnt;$i++)
                        {
                            
                            ?>
                            <!--
                            <div class=" col-md-3 text-center">
                                <a href="<?php echo $site_base.$img_locs[$i]; ?>" data-lightbox="events" data-title=""><img src="<?php echo $site_base.$img_locs[$i]; ?>" alt="" class=" img-thumbnail"></a>
                                <br><br>
                            </div>-->
                            <div class="column1 col-md-6">
                                <img src="<?php echo $site_base.$img_locs[$i]; ?>" onclick="openModal();currentSlide(1)" class="hover-shadow  img-thumbnail">
                            </div>
                                                
                            
                            <?php
                        }
                    }

                ?>
        
                <!-- The Modal/Lightbox -->
                <div id="myModal" class="modal">
                  <span class="close cursor" onclick="closeModal()">&times;</span>
                  <div class="modal-content">


                    <?php
                            $iml_cnt = count($img_locs);
                            if($iml_cnt > 0){
                            
                                for($i=0;$i<$iml_cnt;$i++)
                                {
                                    
                                    ?>
                                    <!--
                                    <div class=" col-md-3 text-center">
                                        <a href="<?php echo $site_base.$img_locs[$i]; ?>" data-lightbox="events" data-title=""><img src="<?php echo $site_base.$img_locs[$i]; ?>" alt="" class=" img-thumbnail"></a>
                                        <br><br>
                                    </div>
                                    <div class="column">
                                        <img src="<?php echo $site_base.$img_locs[$i]; ?>" onclick="openModal();currentSlide(1)" class="hover-shadow">
                                    </div>
                                    -->         
                                    <div class="mySlides">
                                      <!--<div class="numbertext">1 / 4</div>-->
                                      <img src="<?php echo $site_base.$img_locs[$i]; ?>" style="width:100%">
                                    </div>

                                    <?php
                                }
                            }

                        ?>


                    <!-- Next/previous controls -->
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>

                    <!-- Caption text -->
                    <div class="caption-container">
                      <p id="caption"></p>
                    </div>


                  </div>
                </div>


            
            </div>

    
            <?php
            
        }
        ?>

    

</div>