<?php
/**
* @copyright	Copyright (C) 2019 - Base. All rights reserved.
*/

defined('_JEXEC') or die('Restricted access');

$path = $this->baseurl.'/templates/'.$this->template;

$app  = JFactory::getApplication();
$user = JFactory::getUser();
$menu = $app->getMenu();

$active = $menu->getActive();
$menuClassPrefix = '';
$showPageHeading = 0;
$view = JRequest::getVar('view', null);
if ($active) {
    $menuClassPrefix 	= $active->params->get('pageclass_sfx');
}
if($view == "product"){$menuClassPrefix = 'product_details';}
else if($view == "catalog"){$menuClassPrefix = 'catalog_list';}
// Output as HTML5
$this->setHtml5(true);

JHtml::_('bootstrap.framework');

$filepath = JURI::root(true).'/templates/'.$this->template;
$doc = JFactory::getDocument();

$doc->addStyleSheet(JURI::root(true).'/templates/system/css/general.css' , 'text/css', 'all');

// Getting params from template
$params = $app->getTemplate(true)->params;
?>
<!doctype html>
<html lang="<?php echo $this->language; ?>" xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#1B89D9">
    <jdoc:include type="head" />
    <?php JFactory::getDocument()->setGenerator(''); ?>
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $filepath ?>/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $filepath ?>/assets/favicon/favicon-16x16.png">
    <script src="<?php echo $filepath ?>/assets/scriptn.js" defer></script>
    <script src="<?php echo $filepath ?>/assets/hammer.min.js"></script>
    <script src="<?php echo $filepath ?>/assets/jquery.min.js"></script>
    <script src="<?php echo $filepath ?>/assets/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="<?php echo $filepath ?>/assets/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo $filepath ?>/assets/style.css">
</head>
<body>
<!-- Screen dim -->
<div class="screen-dim"></div>
<!-- Header -->
<header>
    <div class="top">
        <div>
            <a class="logo">
                <img src="<?php echo $filepath ?>/assets/img/header_logo.gif" alt="Смета монолит">
                <?php echo $this->params->get('title_text') ; ?>
                <span><?php echo $this->params->get('post_text') ; ?></span>
            </a>
            <div class="installation__delivery">
                <div class="installation">
                    <?php if($this->countModules('top1')) : ?>
                        <jdoc:include type="modules" name="top1" style="joomspirit" />
                    <?php endif; ?>
                </div>
                <div class="delivery">
                    <?php if($this->countModules('top2')) : ?>
                        <jdoc:include type="modules" name="top2" style="joomspirit" />
                    <?php endif; ?>
                </div>
            </div>
            <div class="number">
                <div class="call_but" data-popup="order_master"></div>
                <?php if($this->countModules('top3')) : ?>
                    <jdoc:include type="modules" name="top3" style="joomspirit" />
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="bottom">
        <div>
            <div class="burger_menu"><span></span>Меню</div>
            <?php if($this->countModules('block-menu')) : ?>
                <jdoc:include type="modules" name="block-menu" style="joomspirit" />
            <?php endif; ?>
            <div class="measurement_sign_up">
                            <span data-popup="order_master">Записаться на замер</span>
                        </div>
            <div class="dropdown_menu" style="opacity:0;">
                <div class="additional_close_but"></div>
                <div class="menu">
                    <?php if($this->countModules('home-menu')) : ?>
                        <div class="title">Меню</div>
                        <jdoc:include type="modules" name="home-menu" style="joomspirit" />
                    <?php endif; ?>
                </div>
                <div class="catalog">
                    <?php if($this->countModules('catalog-menu')) : ?>
                        <div class="title">Каталог дверей</div>
                        <jdoc:include type="modules" name="catalog-menu" style="joomspirit" />
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main content -->
<main class="content">
    <jdoc:include type="message" />
    <?php if($menuClassPrefix != 'home' ) : ?>
    <section class="<?php echo $menuClassPrefix; ?>">
    <?php endif; ?>
        <?php if($this->countModules('sidebar') && $view == "catalog") : ?>
        <div class="filters">
            <jdoc:include type="modules" name="sidebar" style="joomspirit" />
        </div>
        <?php endif; ?>
        <?php if($this->countModules('bread-crumb')  && $view != "product" ) : ?>
            <div class="bread_crumbs">
                <jdoc:include type="modules" name="bread-crumb" style="joomspirit" />
            </div>
        <?php endif; ?>
        <jdoc:include type="component" />
    <?php if($menuClassPrefix != 'home' ) : ?>
    </section>
<?php endif; ?>
    <?php if($view == "product" ) : ?>
        <jdoc:include type="modules" name="teasers_product" style="joomspirit" />
    <?php endif; ?>
    <?php if($this->countModules('teasers')) : ?>
            <jdoc:include type="modules" name="teasers" style="joomspirit" />
    <?php endif; ?>
    <?php if($this->countModules('questions')) : ?>
    <!-- Questions form -->
    <section class="questions_form">
        <div class="window">
            <h2>Остались вопросы?</h2>
            <p>Если Вы так и не смогли подобрать дверь или у Вас остались вопросы, просто напишите нам и наш менеджер свяжется с Вами для консультации или помощи в выборе идеальной дверной конструкции.</p>
            {rsform 5}
        </div>
    </section>
    <?php endif; ?>
</main>
<!-- Footer -->
<footer>
    <div class="copy">
        <a class="logo">
            <img src="<?php echo $filepath ?>/assets/img/footer_logo.gif" alt="Смета монолит">
            <?php echo $this->params->get('title_text') ; ?>
            <span><?php echo $this->params->get('post_text') ; ?></span>
        </a>
        <div class="requisites">
            <?php if($this->countModules('footer-sp1')) : ?>
                <jdoc:include type="modules" name="footer-sp1" style="joomspirit" />
            <?php endif; ?>
        </div>
    </div>
    <div class="menus">
        <div class="menu">
            <?php if($this->countModules('footer-sp2')) : ?>
                <jdoc:include type="modules" name="footer-sp2" style="joomspirit" />
            <?php endif; ?>
        </div>
        <div class="catalog">
            <?php if($this->countModules('footer-sp3')) : ?>
                <jdoc:include type="modules" name="footer-sp3" style="joomspirit" />
            <?php endif; ?>
        </div>
    </div>
    <div class="telephone_n_studio_copy">
        <?php if($this->countModules('footer-sp4')) : ?>
            <jdoc:include type="modules" name="footer-sp4" style="joomspirit" />
        <?php endif; ?>
    </div>
</footer>
<!-- Popups -->
<div class="popups">
    <div class="close" data-popup="close"></div>

    <!-- Door cut scheme STANDART -->
    <div class="window door_cut door_cut__standart">
        <span class="close" data-popup="close"></span>
        <div class="cut_scheme_side">
            <div class="title">Конструкция «Стандарт»</div>
            <div class="scheme">
                <ul class="active_number" style="background-position:0px calc(569px);">
                    <li data-scheme-num="1" style="top:75px;left:374px;"></li>
                    <li data-scheme-num="2" style="top:128px;left:374px;"></li>
                    <li data-scheme-num="3" style="top:194px;left:374px;"></li>
                    <li data-scheme-num="4" style="top:270px;left:374px;"></li>
                    <li data-scheme-num="5" style="top:244px;left:68px;"></li>
                    <li data-scheme-num="6" style="top:345px;left:374px;"></li>
                    <li data-scheme-num="7" style="top:176px;left:68px;"></li>
                    <li data-scheme-num="8" style="top:380px;left:67px;"><span style="top:46px;left:307px;"></span></li>
                    <li data-scheme-num="9" style="top:312px;left:68px;"></li>
                    <li data-scheme-num="10" style="top:502px;left:68px;"></li>
                    <li data-scheme-num="11" style="top:502px;left:287px;"></li>
                    <li data-scheme-num="12" style="top:445px;left:68px;"></li>
                </ul>
                <img src="<?php echo $filepath ?>/assets/img/popup_door_cut1_scheme_cut_image.jpg" alt="Срез двери">
            </div>
            <ul class="description_strings_list">
                <li data-scheme-num="1"><span>1.</span> Рама усиленная</li>
                <li data-scheme-num="2"><span>2.</span> Стальной наличник</li>
                <li data-scheme-num="3"><span>3.</span> Полотно</li>
                <li data-scheme-num="4"><span>4.</span> Лист металла (2-5мм.)</li>
                <li data-scheme-num="5"><span>5.</span> Ребро жесткости</li>
                <li data-scheme-num="6"><span>6.</span> Петля на опорном подшипнике</li>
                <li data-scheme-num="7"><span>7.</span> Притвор двери</li>
                <li data-scheme-num="8"><span>8.</span> Отделка двери (на выбор)</li>
                <li data-scheme-num="9"><span>9.</span> Утепление (на выбор)</li>
                <li data-scheme-num="10"><span>10.</span> Утепление рамы и полотна</li>
                <li data-scheme-num="11"><span>11.</span> Резиновый уплотнитель типа “Е”</li>
                <li data-scheme-num="12"><span>12.</span> Резиновый уплотнитель типа “D”</li>
            </ul>
            <div class="order_but" data-popup="close_and__orderDoor_standart">Заказать</div>
        </div>
        <div class="form_side">
            <div class="title">заказать дверь с конструкцией <span class="bold">«Стандарт»</span></div>
            <form action="javascript:void(0)">
                <input type="text" value="Введите ваше имя..." class="placeholder_color">
                <input type="text" value="Введите ваш телефон..." class="placeholder_color">
                <textarea cols="5" rows="5" class="placeholder_color">Есть дополнительные комментарии?
Укажите их тут... </textarea>
                <button type="submit">Отправить сообщение</button>
            </form>
        </div>
    </div>

    <!-- Door cut scheme TERMO -->
    <div class="window door_cut door_cut__termo">
        <span class="close" data-popup="close"></span>
        <div class="cut_scheme_side">
            <div class="title">Конструкция «TERMO»</div>
            <div class="scheme">
                <ul class="active_number" style="background-position:0px calc(569px);">
                    <li data-scheme-num="1" style="top:103px;left:46px;"></li>
                    <li data-scheme-num="2" style="top:81px;left:388px;"></li>
                    <li data-scheme-num="3" style="top:130px;left:388px;"></li>
                    <li data-scheme-num="4" style="top:178px;left:388px;"></li>
                    <li data-scheme-num="5" style="top:216px;left:43px;"></li>
                    <li data-scheme-num="6" style="top:254px;left:388px;"></li>
                    <li data-scheme-num="7" style="top:162px;left:43px;"><span style="top:339px;left:0px;"></span></li>
                    <li data-scheme-num="8" style="top:266px;left:44px;"></li>
                    <li data-scheme-num="9" style="top:365px;left:43px;"><span style="top:-35px;left:346px;"></span></li>
                    <li data-scheme-num="10" style="top:316px;left:43px;"></li>
                    <li data-scheme-num="11" style="top:501px;left:133px;"></li>
                    <li data-scheme-num="12" style="top:502px;left:225px;"></li>
                    <li data-scheme-num="13" style="top:418px;left:43px;"></li>
                </ul>
                <img src="<?php echo $filepath ?>/assets/img/popup_door_cut2_scheme_cut_image.jpg" alt="Срез двери">
            </div>
            <ul class="description_strings_list">
                <li data-scheme-num="1"><span>1.</span> Рама усиленная</li>
                <li data-scheme-num="2"><span>2.</span> Стальной наличник</li>
                <li data-scheme-num="3"><span>3.</span> Полотно</li>
                <li data-scheme-num="4"><span>4.</span> Лист металла (2-5мм.)</li>
                <li data-scheme-num="5"><span>5.</span> Ребро жесткости</li>
                <li data-scheme-num="6"><span>6.</span> Петля на опорном подшипнике</li>
                <li data-scheme-num="7"><span>7.</span> Терморазрыв рамы</li>
                <li data-scheme-num="8"><span>8.</span> Терморазрыв полотна</li>
                <li data-scheme-num="9"><span>9.</span> Отделка двери (на выбор)</li>
                <li data-scheme-num="10"><span>10.</span> Утепление (на выбор)</li>
                <li data-scheme-num="11"><span>11.</span> Резиновый рамы и полотна</li>
                <li data-scheme-num="12"><span>12.</span> Резиновый уплотнитель типа “E”</li>
                <li data-scheme-num="13"><span>13.</span> Резиновый уплотнитель типа “D”</li>
            </ul>
            <div class="order_but" data-popup="close_and__orderDoor_termo">Заказать</div>
        </div>
        <div class="form_side">
            <div class="title">заказать дверь с конструкцией <span class="bold">«TERMO»</span></div>
            <form action="javascript:void(0)">
                <input type="text" value="Введите ваше имя..." class="placeholder_color">
                <input type="text" value="Введите ваш телефон..." class="placeholder_color">
                <textarea cols="5" rows="5" class="placeholder_color">Есть дополнительные комментарии?
Укажите их тут... </textarea>
                <button type="submit">Отправить сообщение</button>
            </form>
        </div>
    </div>

    <!-- Door cut scheme EURO 3K -->
    <div class="window door_cut door_cut__euro3k">
        <span class="close" data-popup="close"></span>
        <div class="cut_scheme_side">
            <div class="title">Конструкция «EURO 3K»</div>
            <div class="scheme">
                <ul class="active_number" style="background-position:0px calc(569px);">
                    <li data-scheme-num="1" style="top:10px;left:211px;"></li>
                    <li data-scheme-num="2" style="top:118px;left:384px;"></li>
                    <li data-scheme-num="3" style="top:192px;left:384px;"></li>
                    <li data-scheme-num="4" style="top:193px;left:60px;"></li>
                    <li data-scheme-num="5" style="top:270px;left:384px;"></li>
                    <li data-scheme-num="6" style="top:11px;left:285px;"></li>
                    <li data-scheme-num="7" style="top:331px;left:59px;"><span style="top:11px;left:326px;"></span></li>
                    <li data-scheme-num="8" style="top:261px;left:60px;"></li>
                    <li data-scheme-num="9" style="top:506px;left:142px;"></li>
                    <li data-scheme-num="10" style="top:506px;left:244px;"></li>
                    <li data-scheme-num="11" style="top:404px;left:60px;"></li>
                </ul>
                <img src="<?php echo $filepath ?>/assets/img/popup_door_cut3_scheme_cut_image.jpg" alt="Срез двери">
            </div>
            <ul class="description_strings_list">
                <li data-scheme-num="1"><span>1.</span> Рама трехконтурная</li>
                <li data-scheme-num="2"><span>2.</span> Цельногнутое полотно из стали</li>
                <li data-scheme-num="3"><span>3.</span> Лист металла</li>
                <li data-scheme-num="4"><span>4.</span> Усиливающий лонжерон</li>
                <li data-scheme-num="5"><span>5.</span> Петля на опорном подшипнике</li>
                <li data-scheme-num="6"><span>6.</span> Треконтурное уплотнение</li>
                <li data-scheme-num="7"><span>7.</span> Отделка двери (на выбор)</li>
                <li data-scheme-num="8"><span>8.</span> Утепление (на выбор)</li>
                <li data-scheme-num="9"><span>9.</span> Утепление рамы</li>
                <li data-scheme-num="10"><span>10.</span> Резиновый уплотнитель типа “Е”</li>
                <li data-scheme-num="11"><span>11.</span> Резиновый уплотнитель типа “D”</li>
            </ul>
            <div class="order_but" data-popup="close_and__orderDoor_euro3k">Заказать</div>
        </div>
        <div class="form_side">
            <div class="title">заказать дверь с конструкцией <span class="bold">«EURO 3K»</span></div>
            <form action="javascript:void(0)">
                <input type="text" value="Введите ваше имя..." class="placeholder_color">
                <input type="text" value="Введите ваш телефон..." class="placeholder_color">
                <textarea cols="5" rows="5" class="placeholder_color">Есть дополнительные комментарии?
Укажите их тут... </textarea>
                <button type="submit">Отправить сообщение</button>
            </form>
        </div>
    </div>

    <!-- Door cut scheme EURO TERMO 3K -->
    <div class="window door_cut door_cut__eurotermo3k">
        <span class="close" data-popup="close"></span>
        <div class="cut_scheme_side">
            <div class="title">Конструкция&nbsp;«EURO TERMO 3K»</div>
            <div class="scheme">
                <ul class="active_number" style="background-position:0px calc(569px);">
                    <li data-scheme-num="1" style="top:209px;left:58px;"></li>
                    <li data-scheme-num="2" style="top:144px;left:387px;"></li>
                    <li data-scheme-num="3" style="top:202px;left:387px;"></li>
                    <li data-scheme-num="4" style="top:75px;left:387px;"></li>
                    <li data-scheme-num="5" style="top:285px;left:387px;"></li>
                    <li data-scheme-num="6" style="top:136px;left:58px;"></li>
                    <li data-scheme-num="7" style="top:344px;left:58px;"><span style="top:8px;left:329px;"></span></li>
                    <li data-scheme-num="8" style="top:258px;left:58px;"></li>
                    <li data-scheme-num="9" style="top:517px;left:155px;"></li>
                    <li data-scheme-num="10" style="top:517px;left:305px;"></li>
                </ul>
                <img src="<?php echo $filepath ?>/assets/img/popup_door_cut4_scheme_cut_image.jpg" alt="Срез двери">
            </div>
            <ul class="description_strings_list">
                <li data-scheme-num="1"><span>1.</span> Рама трехконтурная</li>
                <li data-scheme-num="2"><span>2.</span> Цельногнутое полотно из стали</li>
                <li data-scheme-num="3"><span>3.</span> Лист металла</li>
                <li data-scheme-num="4"><span>4.</span> Дополнительное утепление коробки</li>
                <li data-scheme-num="5"><span>5.</span> Петля на опорном подшипнике</li>
                <li data-scheme-num="6"><span>6.</span> Тройной контур магнитного уплотнения</li>
                <li data-scheme-num="7"><span>7.</span> Отделка двери (на выбор)</li>
                <li data-scheme-num="8"><span>8.</span> Утепление полотна</li>
                <li data-scheme-num="9"><span>9.</span> Утепление рамы</li>
                <li data-scheme-num="10"><span>10.</span> Терморазрыв</li>
            </ul>
            <div class="order_but" data-popup="close_and__orderDoor_eurotermo3k">Заказать</div>
        </div>
        <div class="form_side">
            <div class="title">заказать дверь с конструкцией <span class="bold">«EURO TERMO 3K»</span></div>
            <form action="javascript:void(0)">
                <input type="text" value="Введите ваше имя..." class="placeholder_color">
                <input type="text" value="Введите ваш телефон..." class="placeholder_color">
                <textarea cols="5" rows="5" class="placeholder_color">Есть дополнительные комментарии?
Укажите их тут... </textarea>
                <button type="submit">Отправить сообщение</button>
            </form>
        </div>
    </div>


    <!-- Call master -->
    <div class="window call_master">
        <span class="close" data-popup="close"></span>
        <div class="title">Вызвать мастера на замер</div>
        {rsform 1}
    </div>

    <!-- Order call -->
    <div class="window order_call">
        <span class="close" data-popup="close"></span>
        <div class="title">Заказать обратный звонок</div>
        {rsform 3}
    </div>

    <!-- Order door -->
    <div class="window order_door__standart">
        <span class="close" data-popup="close"></span>
        <div class="title">заказать дверь с конструкцией <span class="bold">«Стандарт»</span></div>
        <form action="javascript:void(0)">
            <input type="text" value="Введите ваше имя..." class="placeholder_color">
            <input type="text" value="Введите ваш телефон..." class="placeholder_color">
            <textarea cols="5" rows="5" class="placeholder_color">Есть дополнительные комментарии?
Укажите их тут... </textarea>
            <button type="submit">Отправить сообщение</button>
        </form>
    </div>

    <!-- Order door -->
    <div class="window order_door__termo">
        <span class="close" data-popup="close"></span>
        <div class="title">заказать дверь с конструкцией <span class="bold">«ТЕРМО»</span></div>
        <form action="javascript:void(0)">
            <input type="text" value="Введите ваше имя..." class="placeholder_color">
            <input type="text" value="Введите ваш телефон..." class="placeholder_color">
            <textarea cols="5" rows="5" class="placeholder_color">Есть дополнительные комментарии?
Укажите их тут... </textarea>
            <button type="submit">Отправить сообщение</button>
        </form>
    </div>

    <!-- Order door -->
    <div class="window order_door__euro3k">
        <span class="close" data-popup="close"></span>
        <div class="title">заказать дверь с конструкцией <span class="bold">«EURO 3K»</span></div>
        <form action="javascript:void(0)">
            <input type="text" value="Введите ваше имя..." class="placeholder_color">
            <input type="text" value="Введите ваш телефон..." class="placeholder_color">
            <textarea cols="5" rows="5" class="placeholder_color">Есть дополнительные комментарии?
Укажите их тут... </textarea>
            <button type="submit">Отправить сообщение</button>
        </form>
    </div>

    <!-- Order door -->
    <div class="window order_door__eurotermo3k">
        <span class="close" data-popup="close"></span>
        <div class="title">заказать дверь с конструкцией <span class="bold">«EURO TERMO 3K»</span></div>
        <form action="javascript:void(0)">
            <input type="text" value="Введите ваше имя..." class="placeholder_color">
            <input type="text" value="Введите ваш телефон..." class="placeholder_color">
            <textarea cols="5" rows="5" class="placeholder_color">Есть дополнительные комментарии?
Укажите их тут... </textarea>
            <button type="submit">Отправить сообщение</button>
        </form>
    </div>

    <!-- Locks catalog -->
    <div class="window locks_catalog">
        <div class="inner_window">
            <div class="close" data-popup="close"><span></span></div>
            <span class="close" data-popup="close"></span>
            <div class="headline">Каталог замков</div>
            <div class="warning_description">
                Здесь представлены только самые популярные замки.<br>
                <span class="bold">Полный каталог замков можно посмотреть у мастера, приехавшего к вам на замер двери.</span><br>
                Также возможна установка ваших замков в любую дверь из каталога.
            </div>
            <ul class="locks_list">
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock1.jpg" alt="Замок">
                    <span class="title">Mottura 54j939 MY KEY</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock2.jpg" alt="Замок">
                    <span class="title">Mottura 54.797</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock3.jpg" alt="Замок">
                    <span class="title">Mottura 54.787</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock4.jpg" alt="Замок">
                    <span class="title">Mottura 52.783</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock5.jpg" alt="Замок">
                    <span class="title">Mottura 52.771</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock6.jpg" alt="Замок">
                    <span class="title">Mottura 52J535 My Key</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock7.jpg" alt="Замок">
                    <span class="title">Mottura 85.983</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock1.jpg" alt="Замок">
                    <span class="title">Mottura 54j939 MY KEY</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock2.jpg" alt="Замок">
                    <span class="title">Mottura 54.797</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock3.jpg" alt="Замок">
                    <span class="title">Mottura 54.787</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock4.jpg" alt="Замок">
                    <span class="title">Mottura 52.783</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock5.jpg" alt="Замок">
                    <span class="title">Mottura 52.771</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock6.jpg" alt="Замок">
                    <span class="title">Mottura 52J535 My Key</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock7.jpg" alt="Замок">
                    <span class="title">Mottura 85.983</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock1.jpg" alt="Замок">
                    <span class="title">Mottura 54j939 MY KEY</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock2.jpg" alt="Замок">
                    <span class="title">Mottura 54.797</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock3.jpg" alt="Замок">
                    <span class="title">Mottura 54.787</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock4.jpg" alt="Замок">
                    <span class="title">Mottura 52.783</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock5.jpg" alt="Замок">
                    <span class="title">Mottura 52.771</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock6.jpg" alt="Замок">
                    <span class="title">Mottura 52J535 My Key</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock7.jpg" alt="Замок">
                    <span class="title">Mottura 85.983</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock1.jpg" alt="Замок">
                    <span class="title">Mottura 54j939 MY KEY</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock2.jpg" alt="Замок">
                    <span class="title">Mottura 54.797</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock3.jpg" alt="Замок">
                    <span class="title">Mottura 54.787</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock4.jpg" alt="Замок">
                    <span class="title">Mottura 52.783</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock5.jpg" alt="Замок">
                    <span class="title">Mottura 52.771</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock6.jpg" alt="Замок">
                    <span class="title">Mottura 52J535 My Key</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock7.jpg" alt="Замок">
                    <span class="title">Mottura 85.983</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock1.jpg" alt="Замок">
                    <span class="title">Mottura 54j939 MY KEY</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock2.jpg" alt="Замок">
                    <span class="title">Mottura 54.797</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock3.jpg" alt="Замок">
                    <span class="title">Mottura 54.787</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock4.jpg" alt="Замок">
                    <span class="title">Mottura 52.783</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock5.jpg" alt="Замок">
                    <span class="title">Mottura 52.771</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock6.jpg" alt="Замок">
                    <span class="title">Mottura 52J535 My Key</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock7.jpg" alt="Замок">
                    <span class="title">Mottura 85.983</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock1.jpg" alt="Замок">
                    <span class="title">Mottura 54j939 MY KEY</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock2.jpg" alt="Замок">
                    <span class="title">Mottura 54.797</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock3.jpg" alt="Замок">
                    <span class="title">Mottura 54.787</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock4.jpg" alt="Замок">
                    <span class="title">Mottura 52.783</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock5.jpg" alt="Замок">
                    <span class="title">Mottura 52.771</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock6.jpg" alt="Замок">
                    <span class="title">Mottura 52J535 My Key</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
                <li>
                    <img src="<?php echo $filepath ?>/assets/img/popup_locks_catalog_lock7.jpg" alt="Замок">
                    <span class="title">Mottura 85.983</span>
                    <ul class="details">
                        <li><span>Класс защиты:</span> 4</li>
                        <li><span>Количество ригелей:</span> 4</li>
                        <li><span>Мультисистема:</span> Да</li>
                        <li><span>Тип механизма замка:</span> сувальдный цилидровый</li>
                        <li><span>Страна:</span> Италия</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>




</div>
<?php if ($this->countModules( 'debug' )) : ?>
    <jdoc:include type="modules" name="debug" />
<?php endif; ?>

<script>
    // Header line style change on scroll
    document.addEventListener('scroll', function(){
        if (window.pageYOffset > 88){
            document.querySelector('header > .bottom').classList.add('scrolled');
        } else{
            document.querySelector('header > .bottom').classList.remove('scrolled');
        };
    });
</script>

</body>
</html>