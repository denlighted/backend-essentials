import {Args, Mutation, Query, Resolver} from '@nestjs/graphql';
import { StudentsService } from './students.service';

@Resolver('Student')
export class StudentsResolver {
  constructor(private readonly studentsService: StudentsService) {}

  @Query('getStudents')
  async getStudents() {
    return this.studentsService.findAll();
  }

  @Query('getStudent')
  async getStudent(@Args('id') id: string) {
    return this.studentsService.findOne(id);
  }

  @Mutation('addStudent')
  async addStudent(
      @Args('lastName') lastName: string,
      @Args('studentGroup') studentGroup: string,
      @Args('ticketNumber') ticketNumber: string,
  ) {
    return this.studentsService.create(lastName, studentGroup, ticketNumber);
  }

  @Mutation('updateStudent')
  async updateStudent(
      @Args('id') id: string,
      @Args('lastName') lastName?: string,
      @Args('studentGroup') studentGroup?: string,
      @Args('ticketNumber') ticketNumber?: string,
  ) {
    // Відфільтровуємо undefined значення
    const updateData = { lastName, studentGroup, ticketNumber };
    Object.keys(updateData).forEach(key => updateData[key] === undefined && delete updateData[key]);

    return this.studentsService.update(id, updateData);
  }

  @Mutation('deleteStudent')
  async deleteStudent(@Args('id') id: string) {
    return this.studentsService.delete(id);
  }
}
