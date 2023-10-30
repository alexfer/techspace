<?php

namespace App\Entity;

use App\Entity\EntryDetails;
use App\Repository\EntryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntryRepository::class)]
#[ORM\Table(name: 'entry')]
#[ORM\Index(columns: ['status', 'type'], name: 'idx')]
class Entry
{

    /**
     * @var array
     */
    const TYPE = [
        'Other' => 'other',
        'Blog' => 'blog',
        'Article' => 'article',
        'News' => 'news',
        'Gallery' => 'gallery',
    ];
    
    const STATUS = [
        'Draft' => 'draft',
        'Published' => 'published',
        'Trashed' => 'trashed',
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class, cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\OneToOne(mappedBy: 'entry', cascade: ['persist', 'remove'])]
    private ?EntryDetails $entryDetails = null;

    #[ORM\Column(type: Types::STRING, columnDefinition: "ENUM('blog', 'article', 'news', 'other')")]
    private ?string $type = null;

    #[ORM\Column(type: Types::STRING, columnDefinition: "ENUM('draft', 'published', 'trashed')")]
    private ?string $status = null;

    #[ORM\Column]
    private ?int $comments = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updated_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $deleted_at = null;

    #[ORM\OneToMany(mappedBy: 'details', targetEntity: EntryAttachment::class)]
    private Collection $entryAttachments;

    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->updated_at = new \DateTime();
        $this->type = self::TYPE['Other'];
        $this->status = self::STATUS['Draft'];
        $this->comments = 0;
        $this->entryAttachments = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isPrivate(): bool
    {
        return true;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     * @return $this
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return $this
     */
    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getComments(): ?int
    {
        return $this->comments;
    }

    /**
     * @param int $comments
     * @return $this
     */
    public function setComments(int $comments): static
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }

    /**
     * @param \DateTimeInterface $created_at
     * @return $this
     */
    public function setCreatedAt(\DateTimeInterface $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    /**
     * @param \DateTimeInterface $updated_at
     * @return $this
     */
    public function setUpdatedAt(\DateTimeInterface $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deleted_at;
    }

    /**
     * @param \DateTimeInterface|null $deleted_at
     * @return $this
     */
    public function setDeletedAt(?\DateTimeInterface $deleted_at): static
    {
        $this->deleted_at = $deleted_at;

        return $this;
    }

    /**
     * @return Collection<int, EntryAttachment>
     */
    public function getEntryAttachments(): Collection
    {
        return $this->entryAttachments;
    }

    public function addEntryAttachment(EntryAttachment $entryAttachment): static
    {
        if (!$this->entryAttachments->contains($entryAttachment)) {
            $this->entryAttachments->add($entryAttachment);
            $entryAttachment->setDetails($this);
        }

        return $this;
    }

    public function removeEntryAttachment(EntryAttachment $entryAttachment): static
    {
        if ($this->entryAttachments->removeElement($entryAttachment)) {
            // set the owning side to null (unless already changed)
            if ($entryAttachment->getDetails() === $this) {
                $entryAttachment->setDetails(null);
            }
        }

        return $this;
    }

    /**
     * @return EntryDetails|null
     */
    public function getEntryDetails(): ?EntryDetails
    {
        return $this->entryDetails;
    }

    public function setEntryDetails(?EntryDetails $entryDetails): static
    {
        // unset the owning side of the relation if necessary
        if ($entryDetails === null && $this->entryDetails !== null) {
            $this->entryDetails->setEntry(null);
        }

        // set the owning side of the relation if necessary
        if ($entryDetails !== null && $entryDetails->getEntry() !== $this) {
            $entryDetails->setEntry($this);
        }

        $this->entryDetails = $entryDetails;

        return $this;
    }
}