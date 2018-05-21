<?php

namespace ListOf\EmployeesBundle\Controller;

use ListOf\EmployeesBundle\Entity\Employees;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Employee controller.
 *
 * @Route("search")
 */
class EmployeesController extends Controller
{

    /**
     * Creates a new employee entity.
     *
     * @Route("/new", name="employees_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $employee = new Employees();
        $form = $this->createForm('ListOf\EmployeesBundle\Form\EmployeesType', $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($employee);
            $em->flush();

            return $this->redirectToRoute('employees_show', array('id' => $employee->getId()));
        }

        return $this->render('employees/new.html.twig', array(
            'employee' => $employee,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a employee entity.
     *
     * @Route("/{id}", name="employees_show")
     * @Method("GET")
     */
    public function showAction(Employees $employee)
    {
        $deleteForm = $this->createDeleteForm($employee);

        return $this->render('employees/show.html.twig', array(
            'employee' => $employee,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing employee entity.
     *
     * @Route("/{id}/edit", name="employees_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Employees $employee)
    {
        $deleteForm = $this->createDeleteForm($employee);
        $editForm = $this->createForm('ListOf\EmployeesBundle\Form\EmployeesType', $employee);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('employees_edit', array('id' => $employee->getId()));
        }

        return $this->render('employees/edit.html.twig', array(
            'employee' => $employee,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a employee entity.
     *
     * @Route("/{id}", name="employees_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Employees $employee)
    {
        $form = $this->createDeleteForm($employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($employee);
            $em->flush();
        }

        return $this->redirectToRoute('search');
    }

    /**
     * Creates a form to delete a employee entity.
     *
     * @param Employees $employee The employee entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Employees $employee)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('employees_delete', array('id' => $employee->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
