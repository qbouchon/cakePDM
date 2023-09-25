<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Files Controller
 *
 * @property \App\Model\Table\FilesTable $Files
 * @method \App\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FilesController extends AppController
{
  
    /**
     * Delete method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $file = $this->Files->get($id);

        //Authorization
        $this->Authorization->authorize($file);


        //Suppression du fichier sur le serveur
        $fileToDeletePath = WWW_ROOT.'ressourcesfiles'.DS.$file->file_path;
        if(file_exists($fileToDeletePath))
        {
            unlink($fileToDeletePath);
        }

        if ($this->Files->delete($file))
            $this->Flash->success(__('The file has been deleted.'));
        else
            $this->Flash->error(__('The file could not be deleted. Please, try again.'));
        
        return $this->redirect(['action' => 'index']);
    }

    public function download($id = null)
    {
        $this->Authorization->skipAuthorization();
        $file = $this->Files->get($id);
     
        return $this->response->withFile($file->getFilePath(),['download' => true, 'name' => $file->name]);

    }


}