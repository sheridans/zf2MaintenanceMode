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
return array(
   'router' => array(
       'routes' => array(
           'zf2MaintenanceMode' => array(
               'type'    => 'Literal',
               'options' => array(
                   'route'    => '/zf2MaintenanceMode',
                   'defaults' => array(
                       '__NAMESPACE__' => 'zf2MaintenanceMode\Controller',
                       'controller'    => 'Index',
                       'action'        => 'index',
                   ),
               ),
           ),
       ),
   ),
    'controllers' => array(
        'invokables' => array(
            'zf2MaintenanceMode\Controller\Index' => 'zf2MaintenanceMode\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    /*
     * zf2MaintenanceMode options
     */
    'zf2MaintenanceMode' => array (
        'enabled'       => true,
        'retry-after'   => 3600,
        'allowed'       => array(
        ),
    ),
);