<?php
/**
 * Created by PhpStorm.
 * User: dungpx
 * Date: 12/25/2017
 * Time: 11:10 AM
 */


namespace dungphanxuan\vnlocation\filters;

use yii\base\ActionFilter;
use yii\web\NotFoundHttpException;

/**
 * LocationFilter is used to restrict access to Region, City, Ward, District controller in frontend when using Yii2-Location with Yii2
 * advanced template.
 *
 * Config
 * 'modules' => [
 *      'go' => [
 *         // following line will restrict access to Go controller from frontend application
 *         'as frontend' => 'dungphanxuan\vnlocation\filters\FrontendFilter',
 *      ],
 * ],
 * @author Dung Phan Xuan <dungphanxuan@gmail.com>
 */
class FrontendFilter extends ActionFilter
{
    /**
     * @var array
     */
    public $controllers = ['region', 'city', 'district', 'ward'];

    /**
     * @param \yii\base\Action $action
     *
     * @return bool
     * @throws \yii\web\NotFoundHttpException
     */

    public function beforeAction($action)
    {
        if (in_array($action->controller->id, $this->controllers)) {
            throw new NotFoundHttpException('Not found');
        }

        return true;
    }
}