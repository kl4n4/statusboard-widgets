<?php

namespace Widget;

use KeenIo\Api;
use Statusboard\TableHtmlFormatter;

class DeploymentsWidget extends AbstractWidget {

    /** @var Api */
    protected $api;

    protected function getParamsRegex() {
        return '/\/(?<environment>[a-z_]*)/';
    }

    public function getWidget() {
        $environment = $this->getParam('environment', 'production');
        $data = [];
        foreach(['Updatemi', 'Updatemi Service'] as $app) {
            $deploymentInfo = $this->getDeploymentInfoFor($environment, $app);
            $data[] = array(
                'name' => @$deploymentInfo['application'] ?: $app,
                'branch' => @$deploymentInfo['branch'],
                'revision' => @$deploymentInfo['revision'],
                'date' => (new \DateTime(@$deploymentInfo['keen']['created_at']))->format('M d, H:i')
            );
        }
        $table = (new TableHtmlFormatter())->setData($data);
        return $table->setTemplate('table-deployments')->toHtml();
    }

    /**
     * @return Api
     */
    protected function getApi() {
        if(!$this->api) {
            $this->api = new Api(API_PROJECT, API_READ_KEY);
        }
        return $this->api;
    }

    protected function getDeploymentInfoFor($environment, $app) {
        $qb = $this->getApi()->getQueryBuilder();
        return @$qb->type($qb::TYPE_EXTRACTION)
            ->collection('deployments')
            ->timezone('UTC')
            ->timeframe('this_14_days')
            ->filters([
                $qb->getFilterExpression('environment', $environment),
                $qb->getFilterExpression('application', $app)
            ])
            ->limit(1)
            ->execute()
            ->toArray()[0];
    }
}
