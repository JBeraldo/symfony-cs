<?php

namespace App\Http\Adapter;

use App\Domain\Entity\Job;
use App\Http\Request\Job\CreateJobRequest;
use App\Http\Request\Job\UpdateJobRequest;
use App\Http\Resource\JobResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class JobAdapter
{

    public static function ResourceToJob(CreateJobRequest | UpdateJobRequest $jobDTO, Job $job = new Job()): Job
    {
        $job->setActive($jobDTO->ativo);
        $job->setMaximumSalary($jobDTO->salario_max);
        $job->setMinimumSalary($jobDTO->salario_min);
        $job->setExperience($jobDTO->experiencia);
        $job->setTitle($jobDTO->titulo);
        $job->setDescription($jobDTO->descricao);
        return $job;
    }

    public static function JobToResouceList(Job $job): JobResource
    {
        $resource = new JobResource();
        $resource->setId($job->getId());
        $resource->setDescricao($job->getDescription());
        $resource->setCompetencias(SkillAdapter::convertSkills($job->getSkills()));
        $resource->setAtivo($job->isActive());
        $resource->setTitulo($job->getTitle());
        $resource->setSalarioMax($job->getMaximumSalary());
        $resource->setSalarioMin($job->getMinimumSalary());
        $resource->setExperiencia($job->getExperience());
        $resource->setEmpresaId($job->getCompany()->getId());
        $resource->setRamo(JobSectorAdapter::sectorToResource($job->getJobSector()));
        return $resource;
    }

    private static function convertCompetencias(Job $job,array $competencias): Collection
    {
        $skills_array = new ArrayCollection();
        foreach ($competencias as $c)
        {
            if(!$job->getSkills()->contains($c)){
                $skills_array->add(SkillAdapter::requestToSkill($c));
            }
        }
        return $skills_array;
    }
    public static function convertJobs(Collection $jobs):array
    {
        $jobs_array = [];
        foreach ($jobs as $j)
        {
            $jobs_array[] = self::JobToResouceList($j);
        }
        return $jobs_array;
    }
}