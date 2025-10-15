<?php
use User;
 class Agenda{

    public readonly int $id;
    public readonly Date $data_reuniao;
    public readonly Time $horario;
    public readonly string $assunto;
    public readonly User $usuario_id;
    public readonly User $personal_id;
    public readonly User $nutri_id;
    public readonly User $google_event_id;
    public readonly string $titulo;

    public function __construct(int $id, Date $data_reuniao, Time $horario, string $assunto, User $usuario_id, User $personal_id, User $nutri_id, User $google_event_id, string $titulo){
        $this->id = $id;      
        $this->data_reuniao = $data_reuniao;
        $this->horario = $horario;
        $this->assunto = $assunto;
        $this->usuario_id = $usuario_id;
        $this->personal_id = $personal_id;
        $this->nutri_id = $nutri_id;
        $this->google_event_id = $google_event_id;
        $this->titulo = $titulo;
    }
        // Getters
        public function getId(): int {
            return $this->id;
        }
        public function getDataReuniao(): Date {
            return $this->data_reuniao;
        }
        public function getHorario(): Time {
            return $this->horario;
        }
        public function getAssunto(): string {
            return $this->assunto;
        }
        public function getUsuarioId(): User {
            return $this->usuario_id;
        }
        public function getPersonalId(): User {
            return $this->personal_id;
        }
        public function getNutriId(): User {
            return $this->nutri_id;
        }
        public function getGoogleEventId(): User {
            return $this->google_event_id;
        }
        public function getTitulo(): string {
            return $this->titulo;
        }

        // Setters
        public function setId(int $id): void {
            $this->id = $id;
        }
        public function setDataReuniao(Date $data_reuniao): void {
            $this->data_reuniao = $data_reuniao;
        }
        public function setHorario(Time $horario): void {
            $this->horario = $horario;
        }
        public function setAssunto(string $assunto): void {
            $this->assunto = $assunto;
        }
        public function setUsuarioId(User $usuario_id): void {
            $this->usuario_id = $usuario_id;
        }
        public function setPersonalId(User $personal_id): void {
            $this->personal_id = $personal_id;
        }
        public function setNutriId(User $nutri_id): void {
            $this->nutri_id = $nutri_id;
        }
        public function setGoogleEventId(User $google_event_id): void {
            $this->google_event_id = $google_event_id;
        }
        public function setTitulo(string $titulo): void {
            $this->titulo = $titulo;
        }
 }
?>