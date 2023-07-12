<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Core\Configure;

/**
 * Configuration Controller
 *
 * @property \App\Model\Table\ConfigurationTable $Configuration
 * @method \App\Model\Entity\Configuration[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ConfigurationController extends AppController
{
   



/**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

        $this->redirect(['action'=>'edit']);
    }

    /**
     * Edit method, configuration is defined in config/bootstrap.php (crest_default_config by default). For now it doesnt handle multiples configurations (à refactorer)
     *
     * @param string|null $id Configuration id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {

        $default_configuration = Configure::read('default_configuration');


        $configuration = $this->Configuration->find()
        ->where(['name' => $default_configuration])->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $configuration = $this->Configuration->patchEntity($configuration, $this->request->getData());
            if ($this->Configuration->save($configuration)) {
                $this->Flash->success(__('The configuration has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The configuration could not be saved. Please, try again.'));
        }
        $this->set(compact('configuration'));
    }

   
}
