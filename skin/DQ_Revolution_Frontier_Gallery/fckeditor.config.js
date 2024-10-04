FCKConfig.ToolbarSets['dqbasic'] = [
['FitWindow','Source'],
['Bold','Italic','Underline','StrikeThrough','RemoveFormat','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyFull','OrderedList','UnorderedList','Outdent','Indent','Blockquote'],
['Link','SpecialChar','Image','Flash','Table','Smiley'],
'/',
['Style','FontName','FontSize','TextColor','BGColor'],
['Find']
];

FCKConfig.ToolbarSets['dqbasic_old'] = [
['StyleSimple','FontNameSimple','FontSizeSimple','TextColor','BGColor'],
['Bold','Italic','Underline','StrikeThrough','RemoveFormat','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyFull','OrderedList','UnorderedList','Outdent','Indent','Blockquote'],
['Link','SpecialChar','Image','Flash','Table','Smiley'],
['Find','FitWindow','ShowBlocks','SourceSimple']
];

FCKConfig.ToolbarSets['dqnormal'] = [
['Source','-','Preview','FitWindow','ShowBlocks','-','Templates'],
['Cut','Copy','Paste','PasteText','PasteWord','-','Print'],
['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat','-','About'],
'/',
['Bold','Italic','Underline','StrikeThrough','-','Subscript','Superscript'],
['OrderedList','UnorderedList','-','Outdent','Indent','Blockquote'],
['JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'],
['Link','Unlink','Anchor'],
['Image','Flash','Table','Smiley','SpecialChar'],
'/',
['Style','FontFormat','FontName','FontSize'],
['TextColor','BGColor']
];

FCKConfig.DefaultLanguage = 'ko';
FCKConfig.ImageUpload = false;
FCKConfig.LinkUpload  = false;
FCKConfig.FlashUpload = false;
FCKConfig.ImageBrowser	= false;
FCKConfig.LinkBrowser	= false;
FCKConfig.FlashBrowser	= false;
FCKConfig.StartupFocus		= true;
FCKConfig.BackgroundBlockerColor = '#000';
//FCKConfig.UseBROnCarriageReturn	= true;

FCKConfig.FontNames		= "굴림;돋움;바탕;궁서;'맑은 고딕',굴림;Arial;Comic Sans MS;Courier New;Tahoma;Times New Roman;Verdana";
FCKConfig.FontSizes		= '7pt;8pt;9pt;10pt;12pt;14pt;18pt;24pt;36pt;72pt';
FCKConfig.DefaultFontSizeLabel = '9pt';
FCKConfig.DefaultFontLabel = '굴림';
//FCKConfig.SmileyPath	= FCKConfig.BasePath + '/images/smiley/cool/';
FCKConfig.SmileyImages	= ['imo000.gif','imo001.gif','imo002.gif','imo003.gif','imo004.gif','imo005.gif','imo006.gif','imo007.gif','imo008.gif','imo009.gif','imo010.gif','imo011.gif','imo012.gif','imo013.gif','imo014.gif','imo015.gif','imo016.gif','imo017.gif','imo018.gif','imo019.gif','imo020.gif','imo021.gif','imo022.gif','imo023.gif','imo024.gif','imo025.gif','imo026.gif','imo027.gif','imo028.gif','imo029.gif','imo030.gif','imo031.gif','imo032.gif','imo033.gif','imo034.gif','imo035.gif','imo036.gif','imo037.gif','imo038.gif','imo039.gif','imo040.gif','imo041.gif','imo042.gif','imo043.gif','imo044.gif','imo045.gif','imo046.gif','imo047.gif','imo048.gif','imo049.gif','imo050.gif','imo051.gif','imo052.gif','imo053.gif','imo054.gif','imo055.gif','imo056.gif','imo057.gif','imo058.gif','imo059.gif','imo060.gif','imo061.gif','imo062.gif','imo063.gif','imo064.gif','imo065.gif','imo066.gif','imo067.gif','imo068.gif','imo069.gif'] ;
FCKConfig.SmileyColumns = 10 ;
FCKConfig.SmileyWindowWidth		= 350 ;
FCKConfig.SmileyWindowHeight	= 350 ;
FCKConfig.ToolbarCanCollapse 	= false ;
var sOtherPluginPath = FCKConfig.BasePath.substr(0, FCKConfig.BasePath.length - 7) + 'editor/plugins/' ;
FCKConfig.Plugins.Add( 'simplecommands', null, sOtherPluginPath ) ;
FCKConfig.TabSpaces = 4;
