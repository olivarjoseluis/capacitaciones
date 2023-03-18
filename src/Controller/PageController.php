<?php

namespace App\Controller;

use App\Entity\Course;
use App\Entity\Subscription;

use App\Repository\SubscriptionRepository;

use Doctrine\ORM\EntityManagerInterface;

use App\Repository\CourseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Form\SubscriptionType;
use App\Form\UnSubscriptionType;

class PageController extends AbstractController
{
  #[Route('/', name: 'app_home')]
  public function home(CourseRepository $course): Response
  {
    if (!$this->getUser()) {
      return $this->redirectToRoute('app_login');
    }
    return $this->render('page/home.html.twig', [
      'courses' => $course->findLatest(),
    ]);
  }

  #[Route('/curso/{slug}', name: 'app_course')]
  public function course(Course $course, EntityManagerInterface $entityManager): Response
  {
    if (!$this->getUser()) {
      return $this->redirectToRoute('app_login');
    }

    $days = [
      'monday' => 'Lunes',
      'tuesday' => 'Martes',
      'wednesday' => 'Miércoles',
      'thursday' => 'Jueves',
      'friday' => 'Viernes'
    ];
    $course->setDay($days[$course->getDay()]);

    $form = $this->createForm(SubscriptionType::class);
    $formCancel = $this->createForm(UnSubscriptionType::class);

    $repository = $entityManager->getRepository(Subscription::class);

    $subscription = $repository->findOneBy(['user' => $this->getUser(), 'course' => $course]);

    return $this->render('page/course.html.twig', [
      'course' => $course,
      'form' => $form,
      'formCancel' => $formCancel,
      'subscription' => $subscription
    ]);
  }

  #[Route('/nueva-suscripcion/{slug}', name: 'app_subscription_new')]
  public function subscription(Request $request, Course $course, EntityManagerInterface $entityManager): Response
  {
    if (!$this->getUser()) {
      return $this->redirectToRoute('app_login');
    }

    $subscription = new Subscription();

    $subscription->setUser($this->getUser());
    $subscription->setCourse($course);

    $form = $this->createForm(SubscriptionType::class, $subscription);
    $form->handleRequest($request);
    //dd($course->getAmount());
    //dd(sizeof($course->getSubscriptions()));

    if ($form->isSubmitted() && $form->isValid() && (sizeof($course->getSubscriptions()) < $course->getAmount())) {
      $entityManager->persist($subscription);
      $entityManager->flush();
      return $this->redirectToRoute('app_course', ['slug' => $course->getSlug()]);
    }

    return $this->redirectToRoute('app_course', ['slug' => $course->getSlug()]);
  }

  #[Route('/cancelar-suscripcion/{slug}', name: 'app_subscription_cancel')]
  public function unSubscription(Request $request, Course $course, Subscription $subscription, EntityManagerInterface $entityManager): Response
  {
    if (!$this->getUser()) {
      return $this->redirectToRoute('app_login');
    }

    $formCancel = $this->createForm(UnSubscriptionType::class);
    $formCancel->handleRequest($request);

    if ($formCancel->isSubmitted() && $formCancel->isValid()) {
      $entityManager->remove($subscription);
      $entityManager->flush();
      return $this->redirectToRoute('app_course', ['slug' => $course->getSlug()]);
    }

    return $this->render('page/course.html.twig', ['course' => $course, 'form' => $formCancel]);
  }
}
