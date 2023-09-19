<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\I18n\FrozenDate;

/**
 * ClosingDates Controller
 *
 * @property \App\Model\Table\ClosingDatesTable $ClosingDates
 * @method \App\Model\Entity\ClosingDate[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClosingDatesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        
        if($this->Authentication->getIdentity()->get('admin'))
            $this->Authorization->skipAuthorization();


        $closingDates = $this->paginate($this->ClosingDates);

        $this->set(compact('closingDates'));
    }

    /**
     * View method
     *
     * @param string|null $id Closing Date id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {   
        if($this->Authentication->getIdentity()->get('admin'))
            $this->Authorization->skipAuthorization();
        $this->redirect(['action'=>'index']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        
        if($this->Authentication->getIdentity()->get('admin'))
            $this->Authorization->skipAuthorization();


        $closingDate = $this->ClosingDates->newEmptyEntity();
        if ($this->request->is('post')) {
            $closingDate = $this->ClosingDates->patchEntity($closingDate, $this->request->getData());
            if ($this->ClosingDates->save($closingDate)) {
                $this->Flash->success(__('The closing date has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The closing date could not be saved. Please, try again.'));
        }
        $this->set(compact('closingDate'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Closing Date id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        
        if($this->Authentication->getIdentity()->get('admin'))
            $this->Authorization->skipAuthorization();

        $closingDate = $this->ClosingDates->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $closingDate = $this->ClosingDates->patchEntity($closingDate, $this->request->getData());
            if ($this->ClosingDates->save($closingDate)) {
                $this->Flash->success(__('The closing date has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The closing date could not be saved. Please, try again.'));
        }
        $this->set(compact('closingDate'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Closing Date id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {

        if($this->Authentication->getIdentity()->get('admin'))
            $this->Authorization->skipAuthorization();

        $this->request->allowMethod(['post', 'delete']);
        $closingDate = $this->ClosingDates->get($id);
        if ($this->ClosingDates->delete($closingDate)) {
            $this->Flash->success(__('The closing date has been deleted.'));
        } else {
            $this->Flash->error(__('The closing date could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    //return an array of all closing beetween two dates 
    public function getAllClosingsDatesBeetween($start = null, $end = null)
    {

        if($this->Authentication->getIdentity()->get('admin'))
                 $this->Authorization->skipAuthorization();

            if($start && $end)
            {

                 $closingDates = $this->ClosingDates->find()
                  ->where([
                                'start_date >=' => $start,
                                'end_date <=' => $end
                    ])
                  ->toArray();

                 $closingDatesTab = [];

                  foreach($closingDates as $closingDate)
                  {
                     
                        $sDate = new FrozenDate($closingDate->start_date);
                        $eDate = new FrozenDate($closingDate->end_date);

                        while($sDate != $eDate)
                        {
                            array_push($closingDatesTab, $sDate);
                            $sDate = $sDate->addDay(1);
                        }
                  }

         

                    // Convertir les données en format JSON et les envoyer en réponse
                        $this->autoRender = false;
                        $this->response = $this->response->withType('application/json')
                            ->withStringBody(json_encode($closingDatesTab));

                        return $this->response;

            }
            else
            {
           
                    $this->Flash->error(__('Erreur dans la récupération des dates de fermeture'));
                    return $this->redirect($this->referer());
            }

    }

    //return an array of all closing dates after today
    public function getAllClosingsDatesAfterToday()
    {

        $this->Authorization->skipAuthorization();

        $now = FrozenDate::now();

     

           

                 $closingDates = $this->ClosingDates->find()
                  ->where([
                                'start_date >=' => $now                       
                    ])
                  ->toArray();

                 $closingDatesTab = [];

                  foreach($closingDates as $closingDate)
                  {
                     
                        $sDate = new FrozenDate($closingDate->start_date);
                        $eDate = new FrozenDate($closingDate->end_date);

                        while($sDate <= $eDate)
                        {
                            array_push($closingDatesTab, $sDate);
                            $sDate = $sDate->addDays(1);
                        }
                  }

         

                    // Convertir les données en format JSON et les envoyer en réponse
                        $this->autoRender = false;
                        $this->response = $this->response->withType('application/json')
                            ->withStringBody(json_encode($closingDatesTab));

                        return $this->response;

          
    }
}
