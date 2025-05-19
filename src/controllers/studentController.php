<?php 

class studentController extends Controller{   
    public function index() {
        $data = $this->student->findAll();
        $this->set(compact("data"));
        $this->render();
    }

    public function view($id) {
        $this->set(["data" => $this->student
            ->find([
                "id" => $id
            ])
        ]);
        $this->render();
    }

    public function add() {
        if(!empty($_POST)) {
            if($this->student->save($_POST)) {
                $this->set(["success" => "Votre étudiant a bien été enregistré"]);
            } else {
                $this->set(["error" => "Une erreur est survenue !"]);
            }
            
        }
        $this->render();
    }

    public function edit($id) {
        $student = $this->student->find($id);
        if(!empty($_POST)) {
            if($this->student->save($_POST) > 0) {
                $this->set(["success" => "Votre étudiant a bien été enregistré"]);
                $student = $this->student->find($id);
            } else {
                $this->set(["error" => "Une erreur est survenue !"]);
            }
            
        }
        $this->set(compact("student"));
        $this->render();
    }

    public function delete($id) {
        if($this->student->delete(["id" => $id]) > 0) {
            $this->set(["success" => "Votre étudiant a bien été supprimé"]);
        } else {
            $this->set(["error" => "Une erreur est survenue !"]);
        }
        $this->render();
    }

}