<?php namespace RV\PhpConsole\Models;

use Model;

/**
 * Script Model
 */
class Script extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'rv_phpconsole_scripts';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function getJsRunResult(){
        return ' <script>console.log = function(message) {$(\'#result\').append(message);};eval(`'.$this->code.'`)</script>';
    }

    public function getPhpRunResult()
    {
        $code = preg_replace('/^ *(<\?php|<\?)/mi', '', $this->code);
        ob_start();
        eval($code);
        $output= ob_get_clean();
        return '<pre class="prettyprint"><code class="prettyprint">'.$output.'</code></pre>';
    }

}
