<?php

require(dirname(__DIR__) . '/vendor/autoload.php');
require(dirname(__DIR__) . '/lib/fpdf/fpdf.php');

use BookEngine\Decorator\Theme\Theme;
use BookEngine\Decorator\Translation\Translation;
use BookEngine\Node\Page;
use BookEngine\Node\Text;
use BookEngine\Render\ImageRenderer;

$page = new Page('myPage');
$page->setWidth(1754);
$page->setHeight(1240);
$text = new Text('myText');
$text->setStyle('heading1');
$text->setX(20);
$text->setY(20);
$text->setText('Page heading text');
$text->setFontFile(__DIR__ . '/../fonts/OpenSans/OpenSans-Regular.ttf');
$text->setFontSize(16);
$text->setFontColor('#000');
$page->addChild($text);

$page = new Theme('myTheme', $page);
$page->addStyle(
    'heading1',
    array(
        'fontFile' => __DIR__ . '/../fonts/OpenSans/OpenSans-Bold.ttf',
        'fontSize' => 48,
        'fontColor' => '#639',
    )
);

$page = new Translation('fi', $page);
$page->addText('Page heading text', 'Sivun otsikkoteksti');

$page->init();

$renderer = new ImageRenderer;
$canvas = $renderer->renderPage($page, false);

$fileName = time() . '.png';
$imagePath = __DIR__ . '/tmp/' . $fileName;
$canvas->save(
    $imagePath,
    array(
        'quality' => 100,
    )
);

$pdf = new FPDF('L');
$pdf->SetMargins(0, 0, 0);
$pdf->Image($imagePath);
$pdf->Output('Page.pdf', 'D');