<?php

App::uses('AppModel', 'Model');

/**
 * Fileupload Model
 *
 */
class Fileupload extends AppModel {

    var $useTable = 'audit_detail_files';
    public $primaryKey = 'audit_detail_file_id';

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';
    public $actsAs = array(
        'FileUpload.FileUpload' => array(
            'uploadDir' => 'files/audit_details',
            'fileModel' => 'Fileupload',
            'fields' => array(
                'name' => 'name',
                'type' => 'type',
                'size' => 'size'
            ),
            'allowedTypes' => array(
                'txt' => 'text/plain', // text
                'asc' => 'text/plain',
                'css' => 'text/css',
                'csv' => 'text/csv',
                'htm' => 'text/html',
                'html' => 'text/html',
                'stm' => 'text/html',
                'rtf' => 'text/rtf',
                'rtx' => 'text/richtext',
                'sgm' => 'text/sgml',
                'sgml' => 'text/sgml',
                'tsv' => 'text/tab-separated-values',
                'tpl' => 'text/template',
                'xml' => 'text/xml',
                'js' => 'text/javascript',
                'xhtml' => 'application/xhtml+xml',
                'xht' => 'application/xhtml+xml',
                'json' => 'application/json',
                'bmp' => 'image/bmp', // image
                'gif' => 'image/gif',
                'jpe' => 'image/jpeg',
                'jpg' => array('image/jpeg', 'image/pjpeg'),
                'jpeg' => 'image/jpeg',
                'pjpeg' => 'image/pjpeg',
                'svg' => 'image/svg+xml',
                'svgz' => 'image/svg+xml',
                'tif' => 'image/tiff',
                'tiff' => 'image/tiff',
                'ico' => 'image/vnd.microsoft.icon',
                'png' => array('image/png', 'image/x-png'),
                'xpng' => 'image/x-png',
                'gz' => 'application/x-gzip', //archive
                'gtar' => 'application/x-gtar',
                'z' => 'application/x-compress',
                'tgz' => 'application/x-compressed',
                'zip' => 'application/zip',
                'rar' => 'application/x-rar-compressed',
                'rev' => 'application/x-rar-compressed',
                'tar' => 'application/x-tar',
                'aif' => 'audio/x-aiff', //audio
                'aifc' => 'audio/x-aiff',
                'aiff' => 'audio/x-aiff',
                'au' => 'audio/basic',
                'kar' => 'audio/midi',
                'mid' => 'audio/midi',
                'midi' => 'audio/midi',
                'mp2' => 'audio/mpeg',
                'mp3' => 'audio/mpeg',
                'mpga' => 'audio/mpeg',
                'ra' => 'audio/x-realaudio',
                'ram' => 'audio/x-pn-realaudio',
                'rm' => 'audio/x-pn-realaudio',
                'rpm' => 'audio/x-pn-realaudio-plugin',
                'snd' => 'audio/basic',
                'tsi' => 'audio/TSP-audio',
                'wav' => 'audio/x-wav',
                'wma' => 'audio/x-ms-wma',
                'flv' => 'video/x-flv', // video
                'fli' => 'video/x-fli',
                'avi' => 'video/x-msvideo',
                'qt' => 'video/quicktime',
                'mov' => 'video/quicktime',
                'movie' => 'video/x-sgi-movie',
                'mp2' => 'video/mpeg',
                'mpa' => 'video/mpeg',
                'mpv2' => 'video/mpeg',
                'mpe' => 'video/mpeg',
                'mpeg' => 'video/mpeg',
                'mpg' => 'video/mpeg',
                'mp4' => 'video/mp4',
                'viv' => 'video/vnd.vivo',
                'vivo' => 'video/vnd.vivo',
                'wmv' => 'video/x-ms-wmv',
                'js' => 'application/x-javascript', // application
                'xlc' => 'application/vnd.ms-excel',
                'xll' => 'application/vnd.ms-excel',
                'xlm' => 'application/vnd.ms-excel',
                'xls' => 'application/vnd.ms-excel',
                'xlsx' => 'application/vnd.ms-excel',
                'xlw' => 'application/vnd.ms-excel',
                'doc' => 'application/msword',
                'docx' => 'application/msword',
                'pptx' => 'application/msword',
                'ppt' => 'application/msword',
                'dot' => 'application/msword',
                'pdf' => 'application/pdf',
                'psd' => 'image/vnd.adobe.photoshop',
                'ai' => 'application/postscript',
                'eps' => 'application/postscript',
                'ps' => 'application/postscript'
            ),
        )
    );

}
