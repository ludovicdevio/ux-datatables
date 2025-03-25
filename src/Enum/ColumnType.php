<?php

namespace Ludovicdevio\UX\DataTables\Enum;

enum ColumnType: string
{
    case DATE = 'date';
    case NUM = 'num';
    case NUM_FMT = 'num-fmt';
    case HTML_NUM = 'html-num';
    case HTML_NUM_FMT = 'html-num-fmt';
    case HTML_UTF8 = 'html-utf8';
    case HTML = 'html';
    case STRING_UTF8 = 'string-utf8';
    case STRING = 'string';
}
