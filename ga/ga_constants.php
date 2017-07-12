<?php

// config
define('LIB_PATH', dirname(__FILE__));
define('KEY_FILE_LOCATION', dirname(__FILE__) . '/ga_api/RoomClip-e90137705816.json');

abstract class GA_PROFILES
{
    const WEB = "";
    const KEY_FILE_LOCATION = LIB_PATH . '';
}

abstract class GA_SCOPE
{
    const READONLY = 'https://www.googleapis.com/auth/analytics.readonly';
}

abstract class GA_METRIC_OPE
{
    const LESS_THAN = 'LESS_THAN'; // 指標値は、比較値より小さくなければなりません。
    const EQUAL = 'EQUAL'; // 指標値は、比較値と正確に一致している必要があります。
    const GREATER_THAN	= 'GREATER_THAN'; // 指標値は、比較値より大きくなければなりません。
    const IS_MISSING = 'IS_MISSING'; // 指標が欠落しているかどうか検証されます。comparisonValue は考慮されません。
}

abstract class GA_DIMENSION_OPE
{
    const REGEXP = 'REGEXP'; // 一致式が正規表現として処理されます。正規表現として処理されないマッチタイプもあります。
    const BEGINS = 'BEGINS_WITH'; // 指定された一致式で始まる値を一致させます。
    const ENDS = 'ENDS_WITH'; // 指定された一致式で終わる値を一致させます。
    const PARTIAL = 'PARTIAL'; // 部分一致。
    const EQUAL = 'EXACT'; // 値が一致式全体と一致する必要があります。
    const NUMERIC_EQUAL	= 'NUMERIC_EQUAL'; // 整数を比較するフィルタ。大文字と小文字の区別は無視され、式は整数を表す文字列と見なされます。失敗の条件を以下に示します。
    const GREATER_THAN = 'NUMERIC_GREATER_THAN'; // ディメンションが一致式よりも数値的に大きいかどうかを調べます。制限については、NUMERIC_EQUALS の説明をご覧ください。
    const LESS_THAN = 'NUMERIC_LESS_THAN'; // ディメンションが一致式よりも数値的に小さいかどうかを調べます。制限については、NUMERIC_EQUALS の説明をご覧ください。
    const IN_LIST = 'IN_LIST'; // このオプションは、選択された値のリストから任意の値を取得できる式を持つディメンション フィルタを指定するために使用されます。すべての単一のレスポンス行について、論理和演算された複数の完全一致ディメンション フィルタを評価しないようにすることができます。例:
}

abstract class GA_DEFAULT_CHANNEL_GROUP
{
    const SEARCH = 'Organic Search';
    const OTHER  = '(Other)';
    const SOCIAL = 'Social';
    const DIRECT = 'DIRECT';
    const REFERRAL = 'Referral';
}

abstract class GA_ORDER
{
    const ASC = 'ASCENDING';
    const DESC = 'DESCENDING';
}

