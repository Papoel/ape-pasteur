<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

    /**
     * @ORM\Entity(repositoryClass=CommentRepository::class)
     */
    class Comment
    {
        use TimestampableEntity;
        /**
         * @ORM\Id
         * @ORM\GeneratedValue
         * @ORM\Column(type="integer")
         */
        private $id;

        /**
         * @ORM\Column(type="string", length=50)
         */
        private $pseudo;

        /**
         * @ORM\Column(type="text")
         */
        private $content;

        /**
         * @ORM\Column(type="datetime_immutable")
         */
        protected $createdAt;

        /**
         * @ORM\Column(type="boolean")
         */
        private $isValidate;

        /**
         * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="comments")
         * @ORM\JoinColumn(nullable=false)
         */
        private $article;

        public function getId(): ?int
        {
            return $this->id;
        }

        public function getPseudo(): ?string
        {
            return $this->pseudo;
        }

        public function setPseudo(string $pseudo): self
        {
            $this->pseudo = $pseudo;

            return $this;
        }

        public function getContent(): ?string
        {
            return $this->content;
        }

        public function setContent(string $content): self
        {
            $this->content = $content;

            return $this;
        }

        public function getCreatedAt(): ?\DateTimeImmutable
        {
            return $this->createdAt;
        }

        public function setCreatedAt(\DateTimeImmutable $createdAt): self
        {
            $this->createdAt = $createdAt;

            return $this;
        }

        public function getIsValidate(): ?bool
        {
            return $this->isValidate;
        }

        public function setIsValidate(bool $isValidate): self
        {
            $this->isValidate = $isValidate;

            return $this;
        }

        public function getArticle(): ?Article
        {
            return $this->article;
        }

        public function setArticle(?Article $article): self
        {
            $this->article = $article;

            return $this;
        }
    }
