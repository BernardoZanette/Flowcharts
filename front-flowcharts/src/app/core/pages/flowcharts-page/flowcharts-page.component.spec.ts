import { ComponentFixture, TestBed } from '@angular/core/testing';

import { FlowchartsPageComponent } from './flowcharts-page.component';

describe('FlowchartsPageComponent', () => {
  let component: FlowchartsPageComponent;
  let fixture: ComponentFixture<FlowchartsPageComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [FlowchartsPageComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(FlowchartsPageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
