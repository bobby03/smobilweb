<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();



	 /**
         * @var string the classes that should be displayed in the body element of each page.
         */
        public $classes;

        /**
         * Make sure we run the parent's constructor method, and call the function to calculate
         * what classes to use.
         */
        public function  __construct($id,$module=null) {
                parent::__construct($id, $module);
                $this->getBodyClasses();
        }

        /** 
         * For easier styling, let's insert some classes from the URI in to our body element
         */
        public function getBodyClasses() {
                if (! empty(Yii::app()->baseUrl)) {
                        $uri = explode(Yii::app()->baseUrl, Yii::app()->request->requestUri);
                        unset($uri[0]);
                        $components = explode("/", implode(Yii::app()->baseUrl, $uri));
                }
                else {
                        $components = explode("/", Yii::app()->request->requestUri);
                }

                foreach ($components as $id => $component) {
                        if (empty($component)) {
                                unset($components[$id]);
                        }
                }
                ksort($components);

                $class = '';
                for ($x = 1; $x <= sizeOf($components); $x++) {
                        if ($x <> 1) {
                                $class .= '-';
                        }
                        $class .= $components[$x];
                        $classes[] = strip_tags($class);
                }

                if (isset($classes)) {
                        $this->classes = implode(' ', $classes);
                }
        }
}