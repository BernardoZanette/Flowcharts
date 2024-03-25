import { ComponentFixture, TestBed } from '@angular/core/testing';

import { FlowchartsManageComponent } from './flowcharts-manage.component';

describe('FlowchartsManageComponent', () => {
  let component: FlowchartsManageComponent;
  let fixture: ComponentFixture<FlowchartsManageComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [FlowchartsManageComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(FlowchartsManageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
