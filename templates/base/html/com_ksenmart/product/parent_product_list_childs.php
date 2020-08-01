<?php 
/**
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
defined('_JEXEC') or die;
$path = $this->baseurl.'/templates/base';
?>
<!-- Doors construction -->
<?php foreach($this->childs_groups as $childs_group){ ?>
    <?php if (count($childs_group->products) > 0){ $i = 0; $l = 0; ?>
        <section class="doors_construction">
            <h2>Конструкции дверей</h2>
            <?php foreach($childs_group->products as $product) {
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
            <?php $i++;  } ?>
        </section>
        <!-- Doors shape select -->
        <section class="doors_shape_select">
            <div class="slider">
                <h3 class="headline">Возможные формы двери:</h3>
                <span class="arr_but left inactive"></span>
                <span class="arr_but right"></span>
                <div class="frames">
                    <ul>
                        <li>
                            <img src="<?php echo $path; ?>/assets/img/main_doors_shape_select1.jpg" alt="Форма двери">
                            <span class="name">Парадная с окнами и ковкой</span>
                        </li>
                        <li>
                            <img src="<?php echo $path; ?>/assets/img/main_doors_shape_select2.jpg" alt="Форма двери">
                            <span class="name">С решеткой и окном</span>
                        </li>
                        <li>
                            <img src="<?php echo $path; ?>/assets/img/main_doors_shape_select3.jpg" alt="Форма двери">
                            <span class="name">Двухстворчатая с глухой полкой</span>
                        </li>
                        <li>
                            <img src="<?php echo $path; ?>/assets/img/main_doors_shape_select4.jpg" alt="Форма двери">
                            <span class="name">Одностворчатая с двумя глухими полками</span>
                        </li>
                        <li>
                            <img src="<?php echo $path; ?>/assets/img/main_doors_shape_select5.jpg" alt="Форма двери">
                            <span class="name">Двухстворчатая с фрамугой</span>
                        </li>
                        <li>
                            <img src="<?php echo $path; ?>/assets/img/main_doors_shape_select1.jpg" alt="Форма двери">
                            <span class="name">Парадная с окнами и ковкой</span>
                        </li>
                        <li>
                            <img src="<?php echo $path; ?>/assets/img/main_doors_shape_select2.jpg" alt="Форма двери">
                            <span class="name">С решеткой и окном</span>
                        </li>
                        <li>
                            <img src="<?php echo $path; ?>/assets/img/main_doors_shape_select3.jpg" alt="Форма двери">
                            <span class="name">Двухстворчатая с глухой полкой</span>
                        </li>
                        <li>
                            <img src="<?php echo $path; ?>/assets/img/main_doors_shape_select4.jpg" alt="Форма двери">
                            <span class="name">Одностворчатая с двумя глухими полками</span>
                        </li>
                        <li>
                            <img src="<?php echo $path; ?>/assets/img/main_doors_shape_select5.jpg" alt="Форма двери">
                            <span class="name">Двухстворчатая с фрамугой</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="warning">
                <div class="headline">Внимание</div>
                <p>Замена цвета и рисунка отделки не влияет на стоимоть. Тип (наружу / внутрь) и направление открывания не влияет на стоимость.</p>
                <p>Возможно изменение конструкции, комплектации и размера двери. Дверь может комплектоваться любыми замками и фурнитурой.</p>
                <p>Мы реализуем любые нестандартные решения по индивидуальным проектам.</p>
            </div>
        </section>
        <!-- Doors details table -->
        <?php $i=0; foreach($childs_group->products as $product) { ?>
        <section class="doors_details_table <?php echo $i == 0 ? 'visible position_static' : 'position_absolute'; ?>" data-grid-tab="<?php echo $i; ?>" data-grid-cnt="<?php echo $i; ?>">
            <h3><?php echo $product->title;?></h3>
            <div class="column">
                <div class="headline visible">
                    <img src="<?php echo $path; ?>/assets/img/main_doors_details_table_icon1.png" alt="Конструкция двери">
                    Конструкция двери
                </div>
                <ul class="table visible">
                    <?php foreach($product->properties as $property){
                        if($property->suffix == "konst"){?>
                                <li>
                                    <div><?php echo $property->title; ?></div>
                                    <?php foreach($property->values as $el){?>
                                        <div><?php echo $el->title; ?></div>
                                    <?php }?>
                                </li>
                            <?php
                        }else{continue;}
                    }?>
                </ul>
                <div class="headline">
                    <img src="<?php echo $path; ?>/assets/img/main_doors_details_table_icon2.png" alt="Конструкция двери">
                    Дополнительная информация
                </div>
                <ul class="table">
                    <?php foreach($product->properties as $property){
                        if($property->suffix == "osoben"){
                            foreach($property->values as $el){?>
                                <?php if($el->id == 4335){?>
                                <li>
                                    <div>Уровень шума</div>
                                    <div><?php echo $el->title; ?></div>
                                </li>
                                <?php }else if($el->id == 4336){ ?>
                                    <li>
                                        <div>Температурный режим</div>
                                        <div><?php echo $el->title; ?></div>
                                    </li>
                                <?php }else{ ?>
                                    <li>
                                        <div><?php echo $el->title; ?></div>
                                        <div><?php echo $el->title; ?></div>
                                    </li>
                                <?php }
                            }
                        }else{continue;}
                    }?>
                </ul>
            </div>
            <div class="column">
                <div class="headline">
                    <img src="<?php echo $path; ?>/assets/img/main_doors_details_table_icon3.png" alt="Конструкция двери">
                    Отделка двери
                </div>
                <ul class="table">
                    <?php foreach($product->properties as $property){
                        if($property->suffix == "otdelk"){ ?>
                            <li>
                                <div><?php echo $property->title; ?></div>
                                <?php foreach($property->values as $el){?>
                                    <div><?php echo $el->title; ?><?php echo $property->id == 47 ? '' : '<br><a><span>посмотреть цвета отделки</span></a>'; ?></div>
                                <?php }?>
                            </li>
                            <?php
                        }else{continue;}
                    }?>
                </ul>
                <div class="headline">
                    <img src="<?php echo $path; ?>/assets/img/main_doors_details_table_icon4.png" alt="Конструкция двери">
                    Комплектация двери
                </div>
                <ul class="table">
                    <?php foreach($product->properties as $property){
                        if($property->suffix == "kompl"){ ?>
                            <li>
                                <div><?php echo $property->title; ?></div>
                                <?php foreach($property->values as $el){?>
                                    <div><?php echo $el->title; ?></div>
                                <?php }?>
                            </li>
                            <?php
                        }else{continue;}
                    }?>
                </ul>
            </div>
        </section>
        <?php $i++; } ?>
    <?php } ?>
<?php } ?>