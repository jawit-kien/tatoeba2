#############################################################################
## data source definition
#############################################################################

## Note that we read in some values from app/config/database.php.
## That file, which is not under source control, is copied from 
## app/config/database.php.template (which IS under source control)
## and then manually edited.
 
<?php
define('__TAT_ROOT__', dirname(dirname(dirname(__FILE__))));
require_once(__TAT_ROOT__.'/app/config/database.php');
require_once(__TAT_ROOT__.'/app/vendors/languages_lib.php');


$configs = get_class_vars('DATABASE_CONFIG');
$sourcePath = $configs['sphinx']['indexdir'];
$sphinxLogDir = $configs['sphinx']['logdir'];

class Configure {
    function read() {}
}
function __($string, $return = false) {
    return $string;
}
$languages = LanguagesLib::languagesInTatoeba();

$languageWithStemmer = array(
    "deu"=>0,
    "spa"=>0,
    "fra"=>0,
    "nld"=>0,
    "por"=>0,
    "rus"=>0,
    "fin"=>0,
    "ita"=>0,
    "tur"=>0,
    "swe"=>0,
    "eng"=>0,
);




$cjkLanguages = array(
    "kor" => 0,
    "cmn" => 0,
    "wuu" => 0,
    "jpn" => 0,
    "yue" => 0,
    'nan' => 0,
    'ain' => 0,
    'lzh' => 0
);

$charsetTableBase = array(
    # Ascii
    '0..9', 'a..z', '_', 'A..Z->a..z',
    # Latin-1 Supplement, with case folding (0080-00FF)
    'U+C0..U+D6->U+E0..U+F6', 'U+D8..U+DE->U+F8..U+FE', 'U+E0..U+F6', 'U+F8..U+FF',
    # Latin extended-A, with case folding (0100-017F)
    'U+100..U+177/2', 'U+178->U+FF', 'U+179..U+17E/2', 'U+017F',
    # Latin extended-B, with case folding (0180-024F)
    'U+0180', 'U+0181->U+0253', 'U+0182..U+0185/2', 'U+0186->U+0254', 'U+0187->U+0188', 'U+0188',
    'U+0189->U+0256', 'U+018A->U+0257', 'U+018B->U+018C', 'U+018C', 'U+018D', 'U+018E->U+01DD', 'U+018F->U+0259',
    'U+0190->U+025B', 'U+0191->U+0192', 'U+0192', 'U+0193->U+0260', 'U+0194->U+0263', 'U+0195', 'U+0196->U+0269', 'U+0197->U+0268', 'U+0198->U+0199',
    'U+0199..U+019B', 'U+019C->U+026F', 'U+019D->U+0272', 'U+019E', 'U+019F->U+0275',
    'U+01A0..U+01A5/2', 'U+01A6->U+0280', 'U+01A7->U+01A8', 'U+01A8',
    'U+01A9->U+0283', 'U+01AA', 'U+01AB', 'U+01AC->U+01AD', 'U+01AD', 'U+01AE->U+0288', 'U+01AF->U+01B0',
    'U+01B0', 'U+01B1->U+028A', 'U+01B2->U+028B', 'U+01B3..U+01B6/2', 'U+01B7->U+0292', 'U+01B8->U+01B9',
    'U+01BA', 'U+01BB', 'U+01BC->U+01BD', 'U+01BD..U+01BF',
    'U+01C0..U+01C3', 'U+01C4->U+01C6', 'U+01C5', 'U+01C6', 'U+01C7->U+01C9', 'U+01C8',
    'U+01C9..U+01CC', 'U+01CD..U+01DC/2', 'U+01DE..U+01EF/2',
    'U+01F0', 'U+01F1->U+01F3', 'U+01F2', 'U+01F3', 'U+01F4->U+01F5', 'U+01F5', 'U+01F6->U+0195', 'U+01F7->U+01BF', 'U+01F8..U+021F/2',
    'U+0220->U+019E', 'U+0221', 'U+0222..U+0233/2', 'U+0234..U+0238',
    'U+0239', 'U+023A->U+2C65', 'U+023B->U+023C', 'U+023C', 'U+023D->U+019A', 'U+023E->U+2C66', 'U+023F',
    'U+0240', 'U+0241->U+0242', 'U+0242', 'U+0243->U+0180', 'U+0244->U+0289', 'U+0245->U+028C', 'U+0246..U+024F/2',
    # Latin Extended Additional, with case folding (1E00-1EFF)
    'U+1E00..U+1E95/2', 'U+1E96..U+1E9F', 'U+1EA0..U+1EFF/2',
    # Combining Diacritical Marks
    'U+300..U+36F',
    # Arabic
    'U+621..U+63a', 'U+640..U+64a',
    'U+66e..U+66f', 'U+671..U+6d3', 'U+6d5', 'U+6e5..U+6e6', 'U+6ee..U+6ef', 'U+6fa..U+6fc', 'U+6ff',
    # Greek and Coptic
    'U+37a', 'U+386..U+389->U+3ac..U+3af', 'U+38c..U+38e->U+3cc..U+3ce', 'U+390', 'U+391..U+3a1->U+3b1..U+3c1',
    'U+3a3..U+3ab->U+3c3..U+3cb', 'U+3ac..U+3ce', 'U+3d0..U+3d7', 'U+3d8..U+3ef/2', 'U+3f0..U+3f3', 'U+3f4->U+3b8',
    'U+3f5', 'U+3f7..U+3f8/2', 'U+3f9->U+3f2', 'U+3fa..U+3fb/2', 'U+3fc..U+3ff',
    # Hebrew
    'U+5d0..U+5ea', 'U+5f0..U+5f2',
    # Cyrillic
    'U+410..U+42F->U+430..U+44F', 'U+430..U+44F',
    # Georgian
    'U+10a0..U+10c5->U+2d00..U+2d25', 'U+10d0..U+10fa', 'U+10fc', 'U+2d00..U+2d25',
    # Bengali
    'U+980..U+9FC',
    # Devanagari + Devanagari Extended
    'U+900..U+97F', 'U+A8E0..U+A8FB',
    # Armenian + Alphabetic Presentation Forms (Armenian Small Ligatures)
    'U+531..U+58A', 'U+FB13..U+FB17',
    # Malayalam
    'U+D00..U+D77',
    # Various Cyrillic letters; I don't get the logic
    'U+492', 'U+493', 'U+4E2', 'U+4E3', 'U+49A', 'U+49B', 'U+4EE', 'U+4EF', 'U+4B2', 'U+4B3', 'U+4B6', 'U+4B7',
    # Ethiopic
    'U+1200..U+1248', 'U+124A..U+124D', 'U+1250..U+1256', 'U+1258', 'U+125A..U+125D', 'U+1260..U+1288',
    'U+128A..U+128D', 'U+1290..U+12B0', 'U+12B2..U+12B5', 'U+12B8..U+12BE', 'U+12C0', 'U+12C2..U+12C5',
    'U+12C8..U+12D6', 'U+12D8..U+1310', 'U+1312..U+1315', 'U+1318..U+135A', 'U+135D..U+135F', 'U+1369..U+137C',
    'U+1380..U+1399', 'U+2D80..U+2DA6', 'U+2DA8..U+2DAE', 'U+2DB0..U+2DB6', 'U+2DB8..U+2DBE', 'U+2DC0..U+2DC6',
    'U+2DC8..U+2DCE', 'U+2DD0..U+2DD6', 'U+2DD8..U+2DDE', 'U+AB01..U+AB06', 'U+AB09..U+AB0E', 'U+AB11..U+AB16',
    'U+AB20..U+AB26', 'U+AB28..U+AB2E',
    # Cherokee
    'U+13A0..U+13F4',
    # Mon (called Myanmar by Unicode)
    'U+1000..U+1049', 'U+104C..U+109F', 'U+AA60..U+AA7F', 'U+A9E0..U+A9FE',
    # Shinhala
    'U+0D82', 'U+0D83', 'U+0D85..U+0D96', 'U+0D9A..U+0DB1', 'U+0DB3..U+0DBB', 'U+0DBD', 'U+0DC0..U+0DC6',
    'U+0DCA', 'U+0DCF..U+0DD4', 'U+0DD6', 'U+0DD8..U+0DDF', 'U+0DE6..U+0DEF', 'U+0DF2', 'U+0DF3',
    'U+111E1..U+111E9', 'U+111EA..U+111F4',
    # Tamil
    'U+0B82', 'U+0B83', 'U+0B85..U+0B8A', 'U+0B8E..U+0B90', 'U+0B92..U+0B95', 'U+0B99', 'U+0B9A', 'U+0B9C',
    'U+0B9E', 'U+0B9F', 'U+0BA3', 'U+0BA4', 'U+0BA8..U+0BAA', 'U+0BAE..U+0BB9', 'U+0BBE..U+0BC2', 'U+0BC6..U+0BC8',
    'U+0BCA..U+0BCD', 'U+0BD0', 'U+0BD7', 'U+0BE6..U+0BFA',
    # Telugu
    'U+0C00..U+0C03', 'U+0C05..U+0C0C', 'U+0C0E..U+0C10', 'U+0C12..U+0C28', 'U+0C2A..U+0C39', 'U+0C3D..U+0C44',
    'U+0C46..U+0C48', 'U+0C4A..U+0C4D', 'U+0C55', 'U+0C56', 'U+0C58', 'U+0C59', 'U+0C60..U+0C63', 'U+0C66..U+0C6F',
    'U+0C78..U+0C7F',
    # Gurmukhi (one of the scripts for [Eastern] Punjabi)
    'U+0A01..U+0A03', 'U+0A05..U+0A0A', 'U+0A0F', 'U+0A10', 'U+0A13..U+0A19', 'U+0A1A..U+0A28', 'U+0A2A..U+0A30',
    'U+0A32', 'U+0A33', 'U+0A35', 'U+0A36', 'U+0A38', 'U+0A39', 'U+0A3C', 'U+0A3E..U+0A42', 'U+0A47', 'U+0A48',
    'U+0A4B..U+0A4D', 'U+0A51', 'U+0A59..U+0A5C', 'U+0A5E', 'U+0A66..U+0A75',
    # Gujarati
    'U+0A81..U+0A83', 'U+0A85..U+0A8D', 'U+0A8F..U+0A91', 'U+0A93..U+0AA8', 'U+0AAA..U+0AB0', 'U+0AB2', 'U+0AB3',
    'U+0AB5..U+0AB9', 'U+0ABC..U+0AC5', 'U+0AC7..U+0AC9', 'U+0ACB..U+0ACD', 'U+0AD0', 'U+0AE0..U+0AE3', 'U+0AE6..U+0AEF',
    # Latin fullwidth to halfwidth
    'U+FF10..U+FF19->U+30..U+39', 'U+FF21..U+FF3A->U+61..U+7A', 'U+FF41..U+FF5A->U+61..U+7A',
    # Katakana halfwidth to fullwidth
    'U+FF66->U+30F2', 'U+FF67->U+30A1', 'U+FF68->U+30A3', 'U+FF69->U+30A5', 'U+FF6A->U+30A7',
    'U+FF6B->U+30A9', 'U+FF6C->U+30E3', 'U+FF6D->U+30E5', 'U+FF6E->U+30E7', 'U+FF6F->U+30C3',
    'U+FF70->U+30FC', 'U+FF71->U+30A2', 'U+FF72->U+30A4', 'U+FF73->U+30A6', 'U+FF74->U+30A8',
    'U+FF75->U+30AA', 'U+FF76->U+30AB', 'U+FF77->U+30AD', 'U+FF78->U+30AF', 'U+FF79->U+30B1',
    'U+FF7A->U+30B3', 'U+FF7B->U+30B5', 'U+FF7C->U+30B7', 'U+FF7D->U+30B9', 'U+FF7E->U+30BB',
    'U+FF7F->U+30BD', 'U+FF80->U+30BF', 'U+FF81->U+30C1', 'U+FF82->U+30C4', 'U+FF83->U+30C6',
    'U+FF84->U+30C8', 'U+FF85..U+FF8A->U+30CA..U+30CF', 'U+FF8B->U+30D2', 'U+FF8C->U+30D5',
    'U+FF8D->U+30D8', 'U+FF8E->U+30DB', 'U+FF8F..U+FF93->U+30DE..U+30E2', 'U+FF94->U+30E4',
    'U+FF95->U+30E6', 'U+FF96->U+30E8', 'U+FF97->U+30E9', 'U+FF98->U+30EA', 'U+FF99->U+30EB',
    'U+FF9A->U+30EC', 'U+FF9B->U+30ED', 'U+FF9C->U+30EF', 'U+FF9D->U+30F3',
    # Hangul halfwidth to fullwidth
    'U+FFA1..U+FFBE->U+3131..U+314E', 'U+FFC2..U+FFC7->U+314F..U+3154',
    'U+FFCA..U+FFCF->U+3155..U+315A', 'U+FFD2..U+FFD7->U+315B..U+3160', 'U+FFDA..U+FFDC->U+3161..U+3163',
    # CJK
    'U+3000..U+FEFF', 'U+FFF0..U+2FA1F',
);

$languagesWithoutWordBoundaries = array(
    # Lao
    'lao' => array(
        'U+0E81', 'U+0E82', 'U+0E84', 'U+0E87', 'U+0E88', 'U+0E8A', 'U+0E8D', 'U+0E94..U+0E97', 'U+0E99..U+0E9F',
        'U+0EA1..U+0EA3', 'U+0EA5', 'U+0EA7', 'U+0EAA', 'U+0EAB', 'U+0EAD', 'U+0EAE', 'U+0EB0..U+0EB9', 'U+0EBB',
        'U+0EC0..U+0EC4', 'U+0EC8..U+0ECD', 'U+0ED0..U+0ED9', 'U+0EDC..U+0EDF',
    ),
    # Tibetan (not sure about marks and signs)
    'bod' => array(
        'U+0F00', 'U+0F20..U+0F33', 'U+0F40..U+0F47', 'U+0F49..U+0F6C', 'U+0F71..U+0F87', 'U+0F90..U+0F97',
        'U+0F99..U+0FBC', 'U+0FD0..U+0FD2',
    ),
    # Khmer
    'khm' => array('U+1780..U+17D2', 'U+17E0..U+17E9', 'U+17F0..U+17F9', 'U+19E0..U+19FF'),
    # Thai
    'tha' => array('U+0E01..U+0E2E', 'U+0E30..U+0E3A', 'U+0E40..U+0E4E', 'U+0E50..U+0E59'),
);
$charsetTableBase = array_merge($charsetTableBase, call_user_func_array('array_merge', array_values($languagesWithoutWordBoundaries)));

$indexExtraOptions = array(
    /* Lojban uses apostrophe as a regular character
     * and sometimes replaces it with h */
    'jbo' => "
        charset_table = ".implode(', ', array_merge(
            array(
                'A..G->a..g', 'a..g',
                "H->'", "h->'", "'",
                'I..Z->i..z', 'i..z'
            ),
            array_filter(
                $charsetTableBase,
                function($v) { return $v != 'A..Z->a..z' && $v != 'a..z'; }
            )
        ))."\n",
);
?>

source default
{
    type                     = mysql
    sql_host                 = localhost
    sql_user                 = <?php echo $configs['default']['login']; echo "\n"; ?>
    sql_pass                 = <?php echo $configs['default']['password']; echo "\n"; ?>
    sql_db                   = <?php echo $configs['default']['database']; echo "\n"; ?>
    sql_sock                 = <?php echo $configs['sphinx']['socket']; echo "\n"; ?>
    sql_query_pre            = SET NAMES utf8
    sql_query_pre            = SET SESSION query_cache_type=OFF

}


index common_index
{
    index_exact_words       = 1
    index_field_lengths     = 1
    ignore_chars            = U+AD
    charset_table           = <?php echo implode(", ", $charsetTableBase); ?>

    enable_star             = 1
    min_infix_len           = 3
    docinfo                 = extern
    charset_type            = utf-8
}

index cjk_common_index : common_index
{
    ngram_len               = 1
    ngram_chars             = U+3000..U+FEFF, U+FFF0..U+2FA1F
}

#################################################

<?

foreach ($languages as $lang=>$name){

    foreach (array('main', 'delta') as $type) {
        $parent = array(
            "${lang}_main_src" => 'default',
            "${lang}_delta_src" => "${lang}_main_src"
        );
        $source = ($type == 'main') ? "${lang}_main_src" : "${lang}_delta_src";
        echo "
    # $name ($type)
    source $source : $parent[$source]
    {
        sql_query_pre = SET NAMES utf8
        sql_query_pre = SET SESSION query_cache_type=OFF";

        if ($type == 'main') {
            echo "
        sql_query_pre = REPLACE INTO sphinx_delta\
                            SELECT languages.id, COALESCE(MAX(sentences.modified), 0)\
                            FROM languages, sentences\
                            WHERE languages.code = '$lang'\
                            AND sentences.lang = languages.code";
        }

        $delta_condition = ($type == 'main') ?
            'sent_start.modified is null or sent_start.modified <=' :
            'sent_start.modified >';
        echo "
        sql_query = \
            select distinct \
                sent_start.id as id, \
                sent_start.text as text, \
                sent_start.id as id2, \
                sent_end.lang_id as trans_id, \
                UNIX_TIMESTAMP(sent_start.created) as created, \
                UNIX_TIMESTAMP(sent_start.modified) as modified, \
                sent_start.user_id as user_id, \
                (sent_start.correctness + 128) as ucorrectness \
            from \
                sentences sent_start \
            left join \
                sentences_translations as trans \
                on trans.sentence_id = sent_start.id \
            left join \
                sentences_translations as transtrans \
                on trans.translation_id = transtrans.sentence_id \
            left join \
                sentences sent_end ON sent_end.id = \
                IF(trans.sentence_id = transtrans.translation_id, \
                   trans.translation_id, \
                   transtrans.translation_id) \
            where \
                sent_start.lang_id = (select id from languages where code = '$lang') \
            and \
                ($delta_condition ( \
                    select index_start_date from sphinx_delta \
                    where sphinx_delta.lang_id = (select id from languages where code = '$lang') \
                ))

        sql_attr_timestamp = created
        sql_attr_timestamp = modified
        sql_attr_uint = user_id".
    /* "correctness" is an 8-bit signed integer whereas Sphinx only allows
     * unsigned intgerers (actually it allows 64-bit signed integers "bigint"s
     * but it’s a waste of space). So we add 128 an treat it as unsigned,
     * and that’s why the attribute is called "ucorrectness".
     */
"
        sql_attr_uint = ucorrectness
        sql_attr_uint = id2
        sql_attr_multi = uint trans_id from field; SELECT id FROM languages ;
    }
";
        // generate index for this pair
        $parent = "common_index" ;
        if (isset($cjkLanguages[$lang])) {
            $parent = "cjk_common_index";
        }

        $index = ($type == 'main') ?
            "${lang}_main_index : $parent" :
            "${lang}_delta_index : ${lang}_main_index";
        echo "
    index $index
    {
        source = $source
        path = " . $sourcePath . DIRECTORY_SEPARATOR . $lang . '_' . $type;

        if ($type == 'main') {
            if (isset($languageWithStemmer[$lang])) {
                echo "
        morphology              = libstemmer_$lang
        min_stemming_len        = 4";
            }
            if (isset($languagesWithoutWordBoundaries[$lang])) {
                echo "
        ngram_len = 1
        ngram_chars = ".implode(', ', $languagesWithoutWordBoundaries[$lang]);
            }
            if (isset($indexExtraOptions[$lang])) {
                echo $indexExtraOptions[$lang];
            }
        }
        echo "
    }
";
    }
}// end of first foreach




    echo "

index und_index : common_index
{
    type = distributed

    ";
    foreach ($languages as $lang=>$name) {
        echo "    local           = ${lang}_main_index\n";
        echo "    local           = ${lang}_delta_index\n";
    }

    echo"
}
";
?>
indexer
{
    mem_limit               = 64M
}


searchd
{
    port                    = 9312
    log                     = <?php echo $sphinxLogDir . DIRECTORY_SEPARATOR . "searchd.log\n"; ?>
    query_log               = <?php echo $sphinxLogDir . DIRECTORY_SEPARATOR . "query.log\n"; ?>
    read_timeout            = 5
    max_children            = 30

    pid_file                = <?php echo $configs['sphinx']['pidfile'] . "\n"; ?>
    max_matches             = 1000
    seamless_rotate         = 1
    preopen_indexes         = 1
    unlink_old              = 1
    mva_updates_pool        = 16M
}


