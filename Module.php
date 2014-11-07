<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

namespace zf2MaintenanceMode;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();

        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $eventManager->attach(MvcEvent::EVENT_DISPATCH, array($this, 'onDispatch'), 1000);
    }

    public function onDispatch(MvcEvent $e)
    {
        $globalConfig = $e->getApplication()->getServiceManager()->get('config');
        $ourConfig = array_key_exists('zf2MaintenanceMode', $globalConfig)
            ? $globalConfig['zf2MaintenanceMode'] : array();
        $enabled = array_key_exists('enabled', $ourConfig) ? (bool)$ourConfig['enabled'] : false;

        if ($enabled) {
            $remoteAddress = $_SERVER['REMOTE_ADDR'];
            $allowedAddresses = array_key_exists('allowed', $ourConfig) ?
                $ourConfig['allowed'] : array();


            if (!in_array($remoteAddress, $allowedAddresses)) {
                $routeName = $e->getRouteMatch()->getMatchedRouteName();
                if($routeName !== 'zf2MaintenanceMode') {
                    $e->getRouteMatch()->setParam('controller', 'zf2MaintenanceMode\Controller\Index');
                    $e->getRouteMatch()->setParam('action', 'index');
                }
            }
        }
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
