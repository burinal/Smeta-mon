<?php 
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
defined('_JEXEC') or die;
$app  = JFactory::getApplication();
$user = JFactory::getUser();
$menu = $app->getMenu();
$path = JURI::root(true).'/templates/base';
//$path = $this->baseurl.'/templates/base';
?>
<?php $i = 0; $l = 0; ?>
            <section class="doors_construction">
                <h2>Конструкции дверей</h2>
                 <?php foreach($products as $product){
                    if($product->title == "ЕВРО ТЕРМО 3К"){
                        $details_modal = 'doorCut_eurotermo3k';
                        $order_modal = 'orderDoor_eurotermo3k';
                    }
                    else if($product->title == "ЕВРО 3К"){
                        $details_modal = 'doorCut_euro3k';
                        $order_modal = 'orderDoor_euro3k';
                    }
                    else if($product->title == "ТЕРМОРАЗРЫВ"){
                        $details_modal = 'doorCut_termo';
                        $order_modal = 'orderDoor_termo';
                    }
                    else if($product->title == "СТАНДАРТ"){
                        $details_modal = 'doorCut_standart';
                        $order_modal = 'orderDoor_standart';
                    }
                    ?>
                    <div class="type_select <?php echo $i == 0 ? 'active' : ''; ?>" data-grid-tab="<?php echo $i; ?>">
                        <img src="<?php echo $path; ?>/assets/img/main_doots_construction_type<?php echo $i+1 ; ?>.png" alt="Конструкция <?php echo $product->title; ?>">
                        <h3><span>Конструкция</span><?php echo $product->title; ?></h3>
                    </div>
                    <div class="details_block <?php echo $i == 0 ? 'visible position_static' : 'position_absolute'; ?>" data-grid-tab="<?php echo $i; ?>" data-grid-cnt="<?php echo $i; ?>">
                        <div>
                            <h3><?php echo $product->title; ?></h3>
                            <?php echo $product->introcontent; ?>

                            <?php foreach($product->properties as $prop){
                                if($prop->property_id == 37 && !empty($prop->values)){
                                    echo "<h4>Отлично подходит для</h4>";
                                    $m = 0;
                                    foreach($prop->values as $item){
                                        if($item->alias == 'kvartira'){
                                            $props_items[$m] = 'квартиры';
                                        }
                                        else if($item->alias == 'chastnyy_dom'){
                                            $props_items[$m] = 'дома';
                                        }
                                        else if($item->alias == 'ofis'){
                                            $props_items[$m] = 'офиса';
                                        }
                                        else if($item->alias == 'tehnicheskoe_pomeschenie'){
                                            $props_items[$m] = 'технического помещения';
                                        }
                                        else if($item->alias == 'kottedzh'){
                                            $props_items[$m] = 'коттеджа';
                                        }
                                        else if($item->alias == 'pod_ezd'){
                                            $props_items[$m] = 'подъезда';
                                        }
                                        $m++;
                                    }
                                    $str = implode($props_items, ', ');
                                    echo "<p>".$str."</p>";
                                }
                            } ?>
                            <ul class="features">
                                <?php foreach($product->properties as $prop){
                                    if($prop->property_id == 50 && !empty($prop->values)){
                                        foreach($prop->values as $item){?>
                                            <li>
                                                <img src="<?php echo $path; ?>/assets/img/main_construction_deature2.png" alt="<?php echo $item->title; ?>">
                                                <span><?php echo $item->title; ?></span>
                                                <?php echo $item->text; ?>
                                            </li>
                                        <?php }
                                    }
                                    if($prop->property_id == 49 && !empty($prop->values)){
                                        foreach($prop->values as $item){
                                            if($item->alias == "ne_promerzaet_do__40_cel_siya"){ ?>
                                                <li>
                                                    <img src="<?php echo $path; ?>/assets/img/main_construction_deature1.png" alt="<?php echo $item->title; ?>">
                                                    <span>Режим</span>
                                                    <?php echo $item->title; ?>
                                                </li>
                                            <?php }
                                            else if($item->alias == "povyshennaya_shumoizolyaciya"){?>
                                                <li>
                                                    <img src="<?php echo $path; ?>/assets/img/main_construction_deature3.png" alt="<?php echo $item->title; ?>">
                                                    <span>Металл</span>
                                                    <?php echo $item->title; ?>
                                                </li>
                                            <?php }
                                        }
                                    }

                                } ?>
                            </ul>
                            <div class="price__order">
                                <div class="price"><span>ЦЕНА:</span><?php echo $product->val_price; ?></div>
                                <span class="order_but" data-popup="<?php echo $order_modal; ?>">заказать дверь с этой конструкцией</span>
                            </div>
                        </div>
                        <div>
                            <div class="image">
                                <img src="<?php echo $path; ?>/assets/img/main_construction_door_hires<?php echo $i+1 ; ?>.png" alt="<?php echo $product->title; ?>">
                            </div>
                            <span class="details_but" data-popup="<?php echo $details_modal; ?>">Смотреть подробно</span>
                            <div class="price__order">
                                <div class="price"><span>ЦЕНА:</span><?php echo $product->val_price; ?></div>
                                <span class="order_but" data-popup="<?php echo $order_modal; ?>">заказать дверь с этой конструкцией</span>
                            </div>
                        </div>
                    </div>
                     <section class="doors_details_table <?php echo $i == 0 ? 'visible position_static' : 'position_absolute'; ?>" data-grid-tab="<?php echo $i; ?>" data-grid-cnt="<?php echo $i; ?>"></section>
                     <?php $i++;  } ?>
            </section>

        <?php ?>